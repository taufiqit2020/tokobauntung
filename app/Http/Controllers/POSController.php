<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shift;
use App\Models\StockLog;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class POSController extends Controller
{
    /**
     * Tampilkan layar utama POS Kasir.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Cari shift kasir yang aktif
        $activeShift = Shift::where('user_id', $user->id)
            ->where('status', 'open')
            ->first();

        // Jika ada shift aktif tapi dari hari sebelumnya (tanggal berbeda), tutup otomatis & logout
        if ($activeShift && !$activeShift->start_time->isToday()) {
            $cashSales = Transaction::where('shift_id', $activeShift->id)
                ->where('payment_method', 'cash')
                ->sum('grand_total');

            $expectedCash = $activeShift->starting_cash + $cashSales;

            $activeShift->update([
                'end_time' => Carbon::now(),
                'expected_cash' => $expectedCash,
                'actual_cash' => $expectedCash,
                'variance' => 0,
                'status' => 'closed',
                'note' => 'Sistem otomatis menutup shift hari sebelumnya.',
            ]);

            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Shift hari sebelumnya telah ditutup otomatis. Silakan masuk kembali.');
        }

        // Ambil data kategori dan produk untuk diproses di tablet
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $products = Product::where('is_active', true)->get();

        // Pengaturan Toko
        $shopSettings = [
            'name' => Setting::getValue('shop_name', 'BAUNTUNGPOS'),
            'subtitle' => Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO'),
            'address' => Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru Utara'),
            'phone' => Setting::getValue('shop_phone', '0851 6665 7171'),
            'receipt_footer' => Setting::getValue('shop_receipt_footer', "Terimakasih atas Kunjungan Anda\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan"),
            'printer_chars_per_line' => Setting::getValue('printer_chars_per_line', '32'),
        ];

        return view('pos.index', compact('activeShift', 'categories', 'products', 'shopSettings'));
    }

    /**
     * Membuka shift kasir baru.
     */
    public function openShift(Request $request)
    {
        $request->validate([
            'starting_cash' => 'required|numeric|min:0',
        ], [
            'starting_cash.required' => 'Modal awal kasir wajib diisi.',
            'starting_cash.numeric' => 'Modal awal harus berupa angka.',
        ]);

        Shift::create([
            'user_id' => Auth::id(),
            'start_time' => Carbon::now(),
            'starting_cash' => $request->starting_cash,
            'expected_cash' => $request->starting_cash,
            'status' => 'open',
        ]);

        return redirect()->route('pos.index')->with('success', 'Shift kasir berhasil dibuka. Selamat bertugas!');
    }

    /**
     * Menutup shift kasir yang sedang berjalan.
     */
    public function closeShift(Request $request)
    {
        $request->validate([
            'actual_cash' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ], [
            'actual_cash.required' => 'Uang tunai fisik akhir di laci wajib diisi.',
            'actual_cash.numeric' => 'Nominal uang fisik harus berupa angka.',
        ]);

        $shift = Shift::where('user_id', Auth::id())
            ->where('status', 'open')
            ->first();

        if (!$shift) {
            return redirect()->route('pos.index')->withErrors(['starting_cash' => 'Tidak ada shift aktif yang ditemukan.']);
        }

        // Hitung ekspektasi uang tunai di laci = Uang Modal Awal + Total Penjualan Cash
        $cashSales = Transaction::where('shift_id', $shift->id)
            ->where('payment_method', 'cash')
            ->sum('grand_total');

        $expectedCash = $shift->starting_cash + $cashSales;
        $actualCash = $request->actual_cash;
        $variance = $actualCash - $expectedCash;

        $shift->update([
            'end_time' => Carbon::now(),
            'expected_cash' => $expectedCash,
            'actual_cash' => $actualCash,
            'variance' => $variance,
            'status' => 'closed',
            'note' => $request->note,
        ]);

        // Keluar otomatis setelah menutup shift
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Shift kasir berhasil ditutup. Anda telah keluar dari sistem.');
    }

    /**
     * Memproses transaksi penjualan baru (Online).
     */
    public function storeTransaction(Request $request)
    {
        $request->validate([
            'cart' => 'required|array|min:1',
            'subtotal' => 'required|numeric',
            'discount' => 'required|numeric',
            'grand_total' => 'required|numeric',
            'payment_method' => 'required|in:cash,qris',
            'amount_paid' => 'required|numeric',
            'change_due' => 'required|numeric',
        ]);

        $shift = Shift::where('user_id', Auth::id())
            ->where('status', 'open')
            ->first();

        if (!$shift) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses transaksi. Anda harus membuka shift kasir terlebih dahulu.'
            ], 403);
        }

        try {
            $transaction = DB::transaction(function () use ($request, $shift) {
                // Generate nomor invoice
                $todayStr = Carbon::now()->format('Ymd');
                $countToday = Transaction::where('invoice_number', 'like', "TR-{$todayStr}-%")->count();
                $invoiceNumber = "TR-{$todayStr}-" . str_pad($countToday + 1, 4, '0', STR_PAD_LEFT);

                // Buat record transaksi
                $trans = Transaction::create([
                    'invoice_number' => $invoiceNumber,
                    'shift_id' => $shift->id,
                    'user_id' => Auth::id(),
                    'subtotal' => $request->subtotal,
                    'discount' => $request->discount,
                    'tax' => 0.00,
                    'grand_total' => $request->grand_total,
                    'payment_method' => $request->payment_method,
                    'amount_paid' => $request->amount_paid,
                    'change_due' => $request->change_due,
                    'is_synced' => true,
                ]);

                // Input detail produk
                foreach ($request->cart as $item) {
                    $product = Product::findOrFail($item['id']);
                    
                    // Rekam detail transaksi (historical cost and sale prices)
                    $detail = TransactionDetail::create([
                        'transaction_id' => $trans->id,
                        'product_id' => $product->id,
                        'qty' => $item['qty'],
                        'buy_price' => $product->buy_price, // Rekam HPP historis
                        'sell_price' => $product->sell_price,
                        'discount_amount' => $item['discount'] ?? 0.00,
                        'subtotal' => (($product->sell_price - ($item['discount'] ?? 0.00)) * $item['qty']),
                    ]);

                    // Kurangi stok barang
                    $oldStock = $product->stock;
                    $newStock = $oldStock - $item['qty'];
                    $product->update(['stock' => $newStock]);

                    // Catat ke kartu stok (stock logs)
                    StockLog::create([
                        'product_id' => $product->id,
                        'reference_id' => $detail->id,
                        'type' => 'sales',
                        'qty_change' => -$item['qty'],
                        'current_stock' => $newStock,
                        'reason' => "Transaksi Penjualan #{$invoiceNumber}",
                        'user_id' => Auth::id(),
                    ]);
                }

                return $trans;
            });

            // Merakit data struk ESC/POS untuk simulasi pencetakan
            $receiptStructure = $this->generateReceiptRawText($transaction);

            return response()->json([
                'success' => true,
                'invoice_number' => $transaction->invoice_number,
                'receipt' => $receiptStructure,
                'message' => 'Transaksi berhasil disimpan!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menyinkronkan batch transaksi offline dari PWA client.
     */
    public function syncOfflineTransactions(Request $request)
    {
        $request->validate([
            'transactions' => 'required|array',
        ]);

        $user = Auth::user();
        
        // Cari atau buat shift fallback jika tidak ada shift aktif
        $shift = Shift::where('user_id', $user->id)
            ->where('status', 'open')
            ->first();

        if (!$shift) {
            // Buat shift darurat untuk memproses sinkronisasi transaksi offline
            $shift = Shift::create([
                'user_id' => $user->id,
                'start_time' => Carbon::now(),
                'starting_cash' => 0.00,
                'expected_cash' => 0.00,
                'status' => 'open',
                'note' => 'Shift otomatis dibuat untuk sinkronisasi transaksi offline PWA.',
            ]);
        }

        $syncedIds = [];
        $failedCount = 0;

        foreach ($request->transactions as $offlineTrans) {
            try {
                DB::transaction(function () use ($offlineTrans, $shift, $user) {
                    // Cek jika transaksi dengan invoice_number yang sama sudah masuk (idempotensi)
                    if (Transaction::where('invoice_number', $offlineTrans['invoice_number'])->exists()) {
                        return;
                    }

                    // Buat record transaksi
                    $trans = Transaction::create([
                        'invoice_number' => $offlineTrans['invoice_number'],
                        'shift_id' => $shift->id,
                        'user_id' => $user->id,
                        'subtotal' => $offlineTrans['subtotal'],
                        'discount' => $offlineTrans['discount'],
                        'tax' => 0.00,
                        'grand_total' => $offlineTrans['grand_total'],
                        'payment_method' => $offlineTrans['payment_method'],
                        'amount_paid' => $offlineTrans['amount_paid'],
                        'change_due' => $offlineTrans['change_due'],
                        'is_synced' => true,
                        'created_at' => Carbon::parse($offlineTrans['created_at'] ?? now()),
                    ]);

                    // Detail produk
                    foreach ($offlineTrans['cart'] as $item) {
                        // Cari berdasarkan product_code (Kode Barang) karena offline
                        $product = Product::where('product_code', $item['product_code'])->first();
                        
                        if ($product) {
                            $detail = TransactionDetail::create([
                                'transaction_id' => $trans->id,
                                'product_id' => $product->id,
                                'qty' => $item['qty'],
                                'buy_price' => $product->buy_price,
                                'sell_price' => $product->sell_price,
                                'discount_amount' => $item['discount'] ?? 0.00,
                                'subtotal' => (($product->sell_price - ($item['discount'] ?? 0.00)) * $item['qty']),
                                'created_at' => $trans->created_at,
                            ]);

                            // Kurangi stok barang
                            $newStock = $product->stock - $item['qty'];
                            $product->update(['stock' => $newStock]);

                            // Catat ke kartu stok
                            StockLog::create([
                                'product_id' => $product->id,
                                'reference_id' => $detail->id,
                                'type' => 'sales',
                                'qty_change' => -$item['qty'],
                                'current_stock' => $newStock,
                                'reason' => "Transaksi Offline (Disinkronkan) #{$trans->invoice_number}",
                                'user_id' => $user->id,
                                'created_at' => $trans->created_at,
                            ]);
                        }
                    }
                });

                $syncedIds[] = $offlineTrans['local_id']; // Local IndexedDB ID
            } catch (\Exception $e) {
                $failedCount++;
            }
        }

        return response()->json([
            'success' => true,
            'synced_local_ids' => $syncedIds,
            'failed_count' => $failedCount,
            'message' => count($syncedIds) . ' transaksi offline berhasil disinkronkan!'
        ]);
    }

    /**
     * Membentuk format teks struk untuk simulasi printer thermal 58mm (32 Karakter lebar).
     */
    private function generateReceiptRawText(Transaction $transaction)
    {
        $shopName = Setting::getValue('shop_name', 'BAUNTUNGPOS');
        $shopSub = Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO');
        $shopAddr = Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru');
        $shopPhone = Setting::getValue('shop_phone', '0851 6665 7171');
        $footer = Setting::getValue('shop_receipt_footer', "Terimakasih atas Kunjungan Anda\nBarang yang sudah dibeli\ntidak dapat ditukar/dikembalikan");
        $chars = (int) Setting::getValue('printer_chars_per_line', '32');
        
        $user = Auth::user();

        // Dynamic width separator
        $separator = str_repeat('-', $chars);
        
        $out = [];
        $out[] = $this->centerText($shopName, $chars);
        $out[] = $this->centerText($shopSub, $chars);
        
        // Wrap address into multiple lines
        $addrLines = explode("\n", wordwrap($shopAddr, $chars, "\n"));
        foreach ($addrLines as $line) {
            $out[] = $this->centerText($line, $chars);
        }
        $out[] = $this->centerText("Telp: " . $shopPhone, $chars);
        $out[] = $separator;
        
        $tgl = Carbon::parse($transaction->created_at)->format('d-m-Y H:i');
        $kasir = substr($user->name, 0, 10);
        $out[] = $this->rightAlignedLabelValue($tgl, "Ksr: " . $kasir, $chars);
        $out[] = "Struk: " . $transaction->invoice_number;
        $out[] = $separator;
        
        // List items
        $details = TransactionDetail::with('product')->where('transaction_id', $transaction->id)->get();
        foreach ($details as $detail) {
            $prodName = $detail->product->name;
            // Name line wrapped
            $fullName = "[" . $detail->product->product_code . "] " . $prodName;
            $wrappedName = explode("\n", wordwrap($fullName, $chars, "\n", true));
            foreach ($wrappedName as $line) {
                $out[] = str_pad($line, $chars, " ");
            }
            
            // Qty & price line: formatted right aligned
            $qtyPart = "  " . $detail->qty . " " . $detail->product->unit . " x " . number_format($detail->sell_price, 0, ',', '.');
            if ($detail->discount_amount > 0) {
                $qtyPart .= " (D: " . number_format($detail->discount_amount, 0, ',', '.') . ")";
            }
            $subTotalPart = number_format($detail->subtotal, 0, ',', '.');
            
            $spacesNeeded = $chars - strlen($qtyPart) - strlen($subTotalPart);
            if ($spacesNeeded < 1) $spacesNeeded = 1;
            
            $out[] = $qtyPart . str_repeat(' ', $spacesNeeded) . $subTotalPart;
        }
        
        $out[] = $separator;
        
        // Total summary
        $out[] = $this->rightAlignedLabelValue("SUBTOTAL:", number_format($transaction->subtotal, 0, ',', '.'), $chars);
        if ($transaction->discount > 0) {
            $out[] = $this->rightAlignedLabelValue("DISKON:", "-" . number_format($transaction->discount, 0, ',', '.'), $chars);
        }
        $out[] = $this->rightAlignedLabelValue("TOTAL:", number_format($transaction->grand_total, 0, ',', '.'), $chars);
        $out[] = $this->rightAlignedLabelValue("BAYAR (" . strtoupper($transaction->payment_method) . "):", number_format($transaction->amount_paid, 0, ',', '.'), $chars);
        
        if ($transaction->payment_method === 'cash') {
            $out[] = $this->rightAlignedLabelValue("KEMBALI:", number_format($transaction->change_due, 0, ',', '.'), $chars);
        }
        
        $out[] = $separator;
        
        // Split footer lines
        $footerLines = explode("\n", $footer);
        foreach ($footerLines as $fline) {
            $flineWrapped = explode("\n", wordwrap($fline, $chars, "\n", true));
            foreach ($flineWrapped as $wrapped) {
                $out[] = $this->centerText($wrapped, $chars);
            }
        }
        
        return implode("\n", $out);
    }

    private function centerText($text, $width)
    {
        $text = trim($text);
        if (strlen($text) >= $width) {
            return substr($text, 0, $width);
        }
        $padding = ($width - strlen($text)) / 2;
        return str_repeat(' ', floor($padding)) . $text . str_repeat(' ', ceil($padding));
    }

    private function rightAlignedLabelValue($label, $value, $width = 32)
    {
        $spaces = $width - strlen($label) - strlen($value);
        if ($spaces < 1) $spaces = 1;
        return $label . str_repeat(' ', $spaces) . $value;
    }

    /**
     * Mengambil data produk dan kategori terbaru untuk disinkronkan di kasir (AJAX).
     */
    public function getSyncData()
    {
        $products = Product::where('is_active', true)->get();
        $categories = Category::with(['products' => function ($q) {
            $q->where('is_active', true);
        }])->get();

        $activeShift = Shift::where('user_id', \Auth::id())
            ->whereNull('end_time')
            ->first();

        return response()->json([
            'products' => $products,
            'categories' => $categories,
            'active_shift' => $activeShift ? true : false,
        ]);
    }
}
