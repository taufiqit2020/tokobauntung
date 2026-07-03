<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shift;
use App\Models\StockLog;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Expense;
use App\Models\Supplier;
use App\Models\User;
use App\Models\EsTegukIncome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class KeuanganController extends Controller
{
    /**
     * Dashboard Keuangan: Ringkasan Laba Rugi & Performa Toko.
     */
    public function dashboard()
    {
        $today = Carbon::today();
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;

        // 1. Hitung Keuangan Hari Ini
        $revenueToday = Transaction::whereDate('created_at', $today)->sum('grand_total');
        
        $cogsToday = TransactionDetail::whereHas('transaction', function ($q) use ($today) {
            $q->whereDate('created_at', $today);
        })->sum(DB::raw('buy_price * qty'));
        
        $expenseToday = Expense::whereDate('expense_date', $today)->sum('amount');
        $esTegukToday = EsTegukIncome::whereDate('income_date', $today)->sum('amount');
        $grossProfitToday = $revenueToday - $cogsToday;
        $netProfitToday = $grossProfitToday - $expenseToday + $esTegukToday;

        // 2. Hitung Keuangan Bulan Ini
        $revenueMonth = Transaction::whereMonth('created_at', $thisMonth)
            ->whereYear('created_at', $thisYear)
            ->sum('grand_total');
            
        $cogsMonth = TransactionDetail::whereHas('transaction', function ($q) use ($thisMonth, $thisYear) {
            $q->whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear);
        })->sum(DB::raw('buy_price * qty'));
        
        $expenseMonth = Expense::whereMonth('expense_date', $thisMonth)
            ->whereYear('expense_date', $thisYear)
            ->sum('amount');
        $esTegukMonth = EsTegukIncome::whereMonth('income_date', $thisMonth)
            ->whereYear('income_date', $thisYear)
            ->sum('amount');
            
        $grossProfitMonth = $revenueMonth - $cogsMonth;
        $netProfitMonth = $grossProfitMonth - $expenseMonth + $esTegukMonth;

        // 3. Peringatan Stok Tipis
        $lowStockCount = Product::where('stock', '<=', DB::raw('min_stock'))->count();
        $lowStockProducts = Product::where('stock', '<=', DB::raw('min_stock'))->with('category')->take(5)->get();

        // 4. Produk Terlaris (Top Selling)
        $topProducts = TransactionDetail::select('product_id', DB::raw('SUM(qty) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->with('product')
            ->take(5)
            ->get();

        // 5. Shift Aktif & Riwayat Shift Terbaru
        $activeShifts = Shift::where('status', 'open')->with('user')->get();
        $recentShiftLogs = Shift::orderBy('id', 'desc')->with('user')->take(5)->get();

        return view('keuangan.dashboard', compact(
            'revenueToday', 'netProfitToday', 'revenueMonth', 'netProfitMonth',
            'lowStockCount', 'lowStockProducts', 'topProducts', 'activeShifts', 'recentShiftLogs',
            'esTegukToday', 'esTegukMonth'
        ));
    }

    /**
     * CRUD Produk: Daftar Produk, Tambah, Edit, Hapus.
     */
    public function products(Request $request)
    {
        $query = Product::with('category');

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('product_code', 'like', "%{$search}%");
            });
        }

        // Filter kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter stok tipis
        if ($request->filter === 'low_stock') {
            $query->where('stock', '<=', DB::raw('min_stock'));
        }

        $products = $query->orderBy('name', 'asc')->paginate(10);
        $categories = Category::all();

        return view('keuangan.products', compact('products', 'categories'));
    }

    /**
     * Menyimpan produk baru.
     */
    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_code' => 'required|string|unique:products,product_code',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:50',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'wholesale_min_qty' => 'nullable|integer|min:1',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
        ]);

        $product = Product::create($request->all());

        // Catat stok awal ke stock logs
        StockLog::create([
            'product_id' => $product->id,
            'type' => 'intake',
            'qty_change' => $product->stock,
            'current_stock' => $product->stock,
            'reason' => 'Input Stok Awal Produk Baru',
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('keuangan.products')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Memperbarui produk yang ada.
     */
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_code' => 'required|string|unique:products,product_code,' . $product->id,
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:50',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0',
            'wholesale_price' => 'nullable|numeric|min:0',
            'wholesale_min_qty' => 'nullable|integer|min:1',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'is_active' => 'required|boolean',
        ]);

        DB::transaction(function () use ($product, $request) {
            $oldStock = $product->stock;
            $newStock = $request->stock;

            if ($oldStock != $newStock) {
                $qtyChange = $newStock - $oldStock;
                StockLog::create([
                    'product_id' => $product->id,
                    'type' => $qtyChange > 0 ? 'adjustment_plus' : 'adjustment_minus',
                    'qty_change' => $qtyChange,
                    'current_stock' => $newStock,
                    'reason' => 'Koreksi Stok via Edit Produk',
                    'user_id' => Auth::id(),
                ]);
            }

            $product->update($request->all());
        });

        return redirect()->route('keuangan.products')->with('success', 'Data produk berhasil diperbarui.');
    }

    /**
     * Menghapus produk (soft-delete dinonaktifkan / validasi relasi).
     */
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Cek jika produk sudah pernah terjual
        $hasSales = TransactionDetail::where('product_id', $product->id)->exists();
        if ($hasSales) {
            // Nonaktifkan saja agar tidak merusak data history transaksi
            $product->update(['is_active' => false]);
            return redirect()->route('keuangan.products')->with('success', 'Produk memiliki riwayat transaksi. Status produk diubah menjadi NONAKTIF.');
        }

        $product->delete();
        return redirect()->route('keuangan.products')->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Manajemen Kategori Barang: Daftar & CRUD Kategori.
     */
    public function categories(Request $request)
    {
        $query = Category::query();

        // Filter pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $categories = $query->orderBy('name', 'asc')->paginate(10);

        return view('keuangan.categories', compact('categories'));
    }

    /**
     * Menyimpan Kategori baru.
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('keuangan.categories')->with('success', 'Kategori barang baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui Kategori.
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('keuangan.categories')->with('success', 'Kategori barang berhasil diperbarui.');
    }

    /**
     * Menghapus Kategori (dengan validasi relasi produk).
     */
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);

        // Cek jika kategori memiliki produk
        if ($category->products()->exists()) {
            return redirect()->route('keuangan.categories')->withErrors(['delete' => 'Kategori ini tidak dapat dihapus karena masih memiliki produk di dalamnya.']);
        }

        $category->delete();
        return redirect()->route('keuangan.categories')->with('success', 'Kategori barang berhasil dihapus.');
    }

    /**
     * Stock Opname: Riwayat & Form Penyesuaian.
     */
    public function stockOpname(Request $request)
    {
        $products = Product::where('is_active', true)->orderBy('name', 'asc')->get();
        
        $query = StockLog::whereIn('type', ['adjustment_plus', 'adjustment_minus'])
            ->with(['product', 'user'])
            ->orderBy('id', 'desc');

        // Handle Excel export & preview
        if (in_array($request->export, ['excel', 'preview'])) {
            $opnameLogs = $query->get();
            if ($request->export === 'preview') {
                $excelUrl = $request->fullUrlWithQuery(['export' => 'excel']);
                return view('keuangan.stock_opname_preview', compact('opnameLogs', 'excelUrl'));
            }
            $filename = 'laporan-stock-opname-' . Carbon::now()->format('Ymd') . '.xls';

            return response()->view('keuangan.stock_opname_excel', compact(
                'opnameLogs'
            ))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
        }

        $opnameLogs = $query->paginate(15);

        return view('keuangan.stock_opname', compact('products', 'opnameLogs'));
    }

    /**
     * Memproses Stock Opname baru.
     */
    public function storeStockOpname(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'actual_stock' => 'required|integer|min:0',
            'reason' => 'required|string|max:500',
        ], [
            'reason.required' => 'Alasan penyesuaian wajib diisi.',
        ]);

        $product = Product::findOrFail($request->product_id);
        $oldStock = $product->stock;
        $actualStock = $request->actual_stock;
        $qtyChange = $actualStock - $oldStock;

        if ($qtyChange == 0) {
            return redirect()->route('keuangan.stock_opname')->withErrors(['actual_stock' => 'Stok fisik sama dengan stok sistem. Tidak ada penyesuaian yang perlu disimpan.']);
        }

        $type = $qtyChange > 0 ? 'adjustment_plus' : 'adjustment_minus';

        DB::transaction(function () use ($product, $actualStock, $qtyChange, $type, $request) {
            // Update stock
            $product->update(['stock' => $actualStock]);

            // Log adjustment
            StockLog::create([
                'product_id' => $product->id,
                'type' => $type,
                'qty_change' => $qtyChange,
                'current_stock' => $actualStock,
                'reason' => $request->reason,
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->route('keuangan.stock_opname')->with('success', 'Penyesuaian stok opname berhasil disimpan.');
    }

    /**
     * Pengeluaran Toko: Daftar & Tambah Pengeluaran.
     */
    public function expenses(Request $request)
    {
        $query = Expense::with('user');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $categories = ['Listrik & Air', 'Gaji Karyawan', 'Sewa Tempat', 'Kebutuhan Toko', 'Lain-lain'];

        // Total pengeluaran bulan ini
        $totalExpenseThisMonth = Expense::whereMonth('expense_date', Carbon::now()->month)
            ->whereYear('expense_date', Carbon::now()->year)
            ->sum('amount');

        // Handle Excel export & preview
        if (in_array($request->export, ['excel', 'preview'])) {
            $expenses = $query->orderBy('expense_date', 'desc')->get();
            if ($request->export === 'preview') {
                $excelUrl = $request->fullUrlWithQuery(['export' => 'excel']);
                return view('keuangan.expenses_preview', compact(
                    'expenses', 'categories', 'totalExpenseThisMonth', 'excelUrl'
                ));
            }
            $filename = 'laporan-pengeluaran-' . Carbon::now()->format('Ymd') . '.xls';

            return response()->view('keuangan.expenses_excel', compact(
                'expenses', 'categories', 'totalExpenseThisMonth'
            ))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
        }

        $expenses = $query->orderBy('expense_date', 'desc')->paginate(10);

        return view('keuangan.expenses', compact('expenses', 'categories', 'totalExpenseThisMonth'));
    }

    /**
     * Menyimpan Pengeluaran baru.
     */
    public function storeExpense(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'amount' => 'required|numeric|min:1',
            'description' => 'required|string',
            'expense_date' => 'required|date',
        ]);

        Expense::create([
            'category' => $request->category,
            'amount' => $request->amount,
            'description' => $request->description,
            'expense_date' => $request->expense_date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('keuangan.expenses')->with('success', 'Pengeluaran toko berhasil dicatat.');
    }

    /**
     * Laporan Penjualan.
     */
    public function reports(Request $request)
    {
        // Filter rentang tanggal (default: 30 hari terakhir)
        $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->subDays(30)->startOfDay();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();

        // 1. Ambil data quantity per tanggal
        $qtyQuery = DB::table('transaction_details')
            ->join('transactions', 'transaction_details.transaction_id', '=', 'transactions.id')
            ->select(
                DB::raw('DATE(transactions.created_at) as date'),
                DB::raw('SUM(transaction_details.qty) as total_qty')
            )
            ->whereBetween('transactions.created_at', [$startDate, $endDate]);

        if ($request->filled('user_ids') && is_array($request->user_ids)) {
            $qtyQuery->whereIn('transactions.user_id', $request->user_ids);
        }
        if ($request->filled('payment_method')) {
            $qtyQuery->where('transactions.payment_method', $request->payment_method);
        }

        $qtyMap = $qtyQuery->groupBy(DB::raw('DATE(transactions.created_at)'))
            ->pluck('total_qty', 'date')
            ->all();

        // 2. Query utama transaksi harian
        $query = Transaction::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(subtotal) as total_subtotal'),
            DB::raw('SUM(discount) as total_discount'),
            DB::raw('SUM(grand_total) as total_grand_total'),
            DB::raw('SUM(CASE WHEN payment_method = "cash" THEN grand_total ELSE 0 END) as total_cash'),
            DB::raw('SUM(CASE WHEN payment_method = "qris" THEN grand_total ELSE 0 END) as total_qris')
        )
        ->whereBetween('created_at', [$startDate, $endDate]);

        // Filter kasir (multiple selection)
        if ($request->filled('user_ids') && is_array($request->user_ids)) {
            $query->whereIn('user_id', $request->user_ids);
        }

        // Filter metode pembayaran
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        $query->groupBy(DB::raw('DATE(created_at)'));

        $cashiers = User::where('role', 'admin_kasir')->get();

        // Rekap ringkasan periode ini
        $statsQuery = Transaction::whereBetween('created_at', [$startDate, $endDate]);
        if ($request->filled('user_ids') && is_array($request->user_ids)) {
            $statsQuery->whereIn('user_id', $request->user_ids);
        }
        if ($request->filled('payment_method')) {
            $statsQuery->where('payment_method', $request->payment_method);
        }

        $totalRevenue = $statsQuery->sum('grand_total');
        $totalDiscount = $statsQuery->sum('discount');
        $cashRevenue = (clone $statsQuery)->where('payment_method', 'cash')->sum('grand_total');
        $qrisRevenue = (clone $statsQuery)->where('payment_method', 'qris')->sum('grand_total');

        // Handle Excel export & preview
        if (in_array($request->export, ['excel', 'preview'])) {
            $transactions = $query->orderBy(DB::raw('DATE(created_at)'), 'asc')->get();
            
            // Map total_qty ke collection
            $transactions->each(function ($item) use ($qtyMap) {
                $item->total_qty = $qtyMap[$item->date] ?? 0;
            });

            if ($request->export === 'preview') {
                $excelUrl = $request->fullUrlWithQuery(['export' => 'excel']);
                return view('keuangan.reports_preview', compact(
                    'transactions', 'startDate', 'endDate',
                    'totalRevenue', 'totalDiscount', 'cashRevenue', 'qrisRevenue', 'excelUrl'
                ));
            }
            $filename = 'laporan-penjualan-' . $startDate->format('Ymd') . '-to-' . $endDate->format('Ymd') . '.xls';

            return response()->view('keuangan.reports_excel', compact(
                'transactions', 'startDate', 'endDate',
                'totalRevenue', 'totalDiscount', 'cashRevenue', 'qrisRevenue'
            ))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
        }

        $transactions = $query->orderBy(DB::raw('DATE(created_at)'), 'asc')->paginate(15);

        // Map total_qty ke paginator
        $transactions->each(function ($item) use ($qtyMap) {
            $item->total_qty = $qtyMap[$item->date] ?? 0;
        });

        return view('keuangan.reports', compact(
            'transactions', 'cashiers', 'startDate', 'endDate',
            'totalRevenue', 'totalDiscount', 'cashRevenue', 'qrisRevenue'
        ));
    }

    /**
     * Cetak ulang struk transaksi dari laporan penjualan.
     */
    public function printReceipt($id)
    {
        $transaction = Transaction::findOrFail($id);
        $receiptText = $transaction->generateReceiptText();
        
        $encodedText = urlencode($receiptText);
        $baseUrl = url('/');
        $responseUrl = "{$baseUrl}/api/print-receipt?content={$encodedText}";
        $schemeUrl = "my.bluetoothprint.scheme://{$responseUrl}";
        
        return redirect()->away($schemeUrl);
    }

    /**
     * Pemasukan Es Teguk: Daftar & Tambah Pemasukan.
     */
    public function esTegukIncomes(Request $request)
    {
        $query = EsTegukIncome::with('user');

        // Filter rentang tanggal (default: bulan ini)
        $startDate = $request->filled('start_date') ? Carbon::parse($request->start_date)->startOfDay() : Carbon::now()->startOfMonth();
        $endDate = $request->filled('end_date') ? Carbon::parse($request->end_date)->endOfDay() : Carbon::now()->endOfDay();

        $query->whereBetween('income_date', [$startDate->toDateString(), $endDate->toDateString()]);

        // Total pemasukan sesuai filter
        $totalIncomeThisMonth = (clone $query)->sum('amount');

        // Handle Excel export & preview
        if (in_array($request->export, ['excel', 'preview'])) {
            $incomes = $query->orderBy('income_date', 'asc')->get();
            if ($request->export === 'preview') {
                $excelUrl = $request->fullUrlWithQuery(['export' => 'excel']);
                return view('keuangan.es_teguk_preview', compact(
                    'incomes', 'totalIncomeThisMonth', 'excelUrl', 'startDate', 'endDate'
                ));
            }
            $filename = 'laporan-pemasukan-es-teguk-' . $startDate->format('Ymd') . '-sd-' . $endDate->format('Ymd') . '.xls';

            return response()->view('keuangan.es_teguk_excel', compact(
                'incomes', 'totalIncomeThisMonth', 'startDate', 'endDate'
            ))
            ->header('Content-Type', 'application/vnd.ms-excel; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->header('Cache-Control', 'max-age=0');
        }

        $incomes = $query->orderBy('income_date', 'asc')->paginate(10);

        return view('keuangan.es_teguk', compact('incomes', 'totalIncomeThisMonth', 'startDate', 'endDate'));
    }

    /**
     * Menyimpan Pemasukan Es Teguk baru.
     */
    public function storeEsTegukIncome(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string',
            'income_date' => 'required|date',
        ]);

        EsTegukIncome::create([
            'amount' => $request->amount,
            'description' => $request->description,
            'income_date' => $request->income_date,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('keuangan.es_teguk')->with('success', 'Pemasukan Es Teguk berhasil dicatat.');
    }
}
