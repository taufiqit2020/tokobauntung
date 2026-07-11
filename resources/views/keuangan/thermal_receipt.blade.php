<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk {{ $transaction->invoice_number }}</title>
    <style>
        @page {
            size: 58mm auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 11px;
            color: #000;
            background: #fff;
            width: 58mm;
            margin: 0;
            padding: 8px;
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        
        .header {
            margin-bottom: 8px;
            line-height: 1.3;
        }
        .shop-name {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        .meta-info {
            line-height: 1.3;
            margin-bottom: 8px;
        }
        .item-row {
            margin-bottom: 6px;
            line-height: 1.2;
        }
        .item-name {
            font-weight: bold;
            word-wrap: break-word;
        }
        .item-details {
            display: flex;
            justify-content: space-between;
            padding-left: 4px;
        }
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            line-height: 1.3;
        }
        .totals-table td {
            padding: 1px 0;
        }
        .footer {
            margin-top: 10px;
            font-size: 9px;
            line-height: 1.3;
        }
        
        @media print {
            .no-print {
                display: none !important;
            }
        }
        
        /* Floating Print Bar for manual trigger if autostart fails */
        .print-bar {
            background: #1e293b;
            color: white;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: sans-serif;
            font-size: 12px;
            margin-bottom: 10px;
            border-radius: 6px;
        }
        .print-btn {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <!-- Floating Print Bar for Screen Mode -->
    <div class="no-print print-bar">
        <span>Struk Siap Dicetak</span>
        <button class="print-btn" onclick="window.print()">Cetak</button>
    </div>

    <!-- Receipt paper content -->
    <div class="header text-center">
        <span class="shop-name">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }}</span><br>
        <span style="font-size: 9px; text-transform: uppercase;">{{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</span><br>
        <span style="font-size: 8px;">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Banjarbaru') }}</span><br>
        <span style="font-size: 8px;">Telp: {{ \App\Models\Setting::getValue('shop_phone', '0851 6665 7171') }}</span>
    </div>

    <div class="divider"></div>

    <div class="meta-info">
        Waktu: {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i') }} WITA<br>
        Kasir: {{ $transaction->user ? substr($transaction->user->name, 0, 10) : 'Kasir' }}<br>
        Struk: {{ $transaction->invoice_number }}<br>
        Metode: {{ $transaction->payment_method === 'cash' ? 'TUNAI (CASH)' : 'QRIS' }}
    </div>

    <div class="divider"></div>

    <!-- Items -->
    <div class="items-list">
        @foreach($transaction->details as $detail)
            @php
                $prodName = $detail->product ? $detail->product->name : 'Barang Terhapus';
                $prodCode = $detail->product ? $detail->product->product_code : 'N/A';
                $unit = $detail->product ? ($detail->product->unit ?: 'pcs') : 'pcs';
                $totalVal = $detail->qty * $detail->sell_price;
            @endphp
            <div class="item-row">
                <div class="item-name">[{{ $prodCode }}] {{ $prodName }}</div>
                <div class="item-details">
                    <span>{{ $detail->qty }} {{ $unit }} x {{ number_format($detail->sell_price, 0, ',', '.') }}</span>
                    <span class="font-bold">{{ number_format($totalVal, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="divider"></div>

    <!-- Totals -->
    <table class="totals-table">
        <tr>
            <td>Subtotal:</td>
            <td class="text-right">{{ number_format($transaction->subtotal, 0, ',', '.') }}</td>
        </tr>
        @if($transaction->discount > 0)
            <tr style="color: #000;">
                <td>Potongan:</td>
                <td class="text-right">-{{ number_format($transaction->discount, 0, ',', '.') }}</td>
            </tr>
        @endif
        <tr class="font-bold">
            <td>TOTAL:</td>
            <td class="text-right">{{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px;">Bayar:</td>
            <td class="text-right" style="font-size: 9px;">{{ number_format($transaction->cash_amount ?: $transaction->grand_total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td style="font-size: 9px;">Kembali:</td>
            <td class="text-right" style="font-size: 9px;">{{ number_format($transaction->change_amount ?: 0, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="footer text-center">
        Terima Kasih Atas Kunjungan Anda!<br>
        Barang yang sudah dibeli<br>tidak dapat ditukar/dikembalikan.
    </div>

    <script>
        // Trigger auto-print
        window.onload = function() {
            setTimeout(function() {
                window.print();
                // Close the popup after printing completes (or print dialog closes)
                setTimeout(function() {
                    window.close();
                }, 1000);
            }, 300);
        };
    </script>
</body>
</html>
