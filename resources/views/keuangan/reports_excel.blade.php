<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta charset="UTF-8">
    <style>
        /* Excel formatting classes */
        .text {
            mso-number-format: "\@";
            text-align: left;
            border: 0.5pt solid #000000;
        }
        .number {
            mso-number-format: "\@"; /* Treat as text so the .000 formatting shows properly in Excel without system locale interference */
            text-align: right;
            border: 0.5pt solid #000000;
        }
        .date {
            mso-number-format: "yyyy\-mm\-dd\ hh\:mm";
            text-align: left;
            border: 0.5pt solid #000000;
        }
        .header-title {
            font-size: 16px;
            font-weight: bold;
            text-align: center;
        }
        .header-subtitle {
            font-size: 11px;
            text-align: center;
            color: #333333;
            font-weight: bold;
        }
        .header-address {
            font-size: 10px;
            text-align: center;
            color: #555555;
            font-style: italic;
        }
        .table-header {
            background-color: #4f46e5;
            color: #ffffff;
            font-weight: bold;
            text-align: center;
            border: 0.5pt solid #000000;
        }
        .stats-label {
            font-weight: bold;
            background-color: #f3f4f6;
            border: 0.5pt solid #000000;
        }
        .stats-val {
            font-weight: bold;
            text-align: right;
            border: 0.5pt solid #000000;
            mso-number-format: "\@";
        }
        .signature-title {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- 1. HEADER INFO -->
    <table>
        <tr>
            <td colspan="7" class="header-title">LAPORAN PENJUALAN - BAUNTUNGPOS</td>
        </tr>
        <tr>
            <td colspan="7" class="header-subtitle">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} - {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="header-address">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center;">Periode: {{ $startDate->translatedFormat('d F Y') }} s.d. {{ $endDate->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center; font-size: 10px; color: #777777;">Waktu Unduh: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</td>
        </tr>
        @php
            $selectedCashierNames = 'Semua Kasir';
            if (request()->filled('user_ids') && is_array(request('user_ids'))) {
                $selectedCashierNames = \App\Models\User::whereIn('id', request('user_ids'))->pluck('name')->implode(', ');
            }
            $selectedPaymentMethod = 'Semua Metode';
            if (request()->filled('payment_method')) {
                $selectedPaymentMethod = request('payment_method') === 'cash' ? 'TUNAI (CASH)' : 'QRIS';
            }
        @endphp
        <tr>
            <td colspan="7" style="text-align: center; font-size: 9px; color: #555555; font-style: italic;">Kasir: {{ $selectedCashierNames }} | Metode: {{ $selectedPaymentMethod }}</td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
    </table>

    <!-- 2. RINGKASAN FINANSIAL -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="2" class="table-header" style="background-color: #10b981; color: #ffffff;">RINGKASAN KINERJA PERIODE INI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="stats-label">Total Omset Bersih (Grand Total)</td>
                <td class="stats-val" style="color: #10b981;">{{ number_format($totalRevenue, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="stats-label">Total Potongan Grosir</td>
                <td class="stats-val" style="color: #ef4444;">{{ number_format($totalDiscount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="stats-label">Porsi Pembayaran Tunai (Cash)</td>
                <td class="stats-val">{{ number_format($cashRevenue, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="stats-label">Porsi Dompet Digital (QRIS)</td>
                <td class="stats-val" style="color: #0d9488;">{{ number_format($qrisRevenue, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="7" style="font-weight: bold; font-size: 12px; text-decoration: underline;">RINCIAN TRANSAKSI PENJUALAN</td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
    </table>

    <!-- 3. RINCIAN STRUK TRANSAKSI -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th class="table-header">No. Invoice</th>
                <th class="table-header">Tanggal & Waktu</th>
                <th class="table-header">Kasir</th>
                <th class="table-header">Metode Pembayaran</th>
                <th class="table-header">Subtotal</th>
                <th class="table-header">Grosir</th>
                <th class="table-header">Total Akhir</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $trans)
                <tr>
                    <td class="text">{{ $trans->invoice_number }}</td>
                    <td class="date">{{ \Carbon\Carbon::parse($trans->created_at)->format('Y-m-d H:i') }}</td>
                    <td class="text">{{ $trans->user->name }}</td>
                    <td class="text" style="text-align: center; text-transform: uppercase;">{{ $trans->payment_method }}</td>
                    <td class="number">{{ number_format($trans->subtotal, 0, ',', '.') }}</td>
                    <td class="number" style="color: #ef4444;">{{ number_format($trans->discount, 0, ',', '.') }}</td>
                    <td class="number" style="font-weight: bold; color: #4f46e5;">{{ number_format($trans->grand_total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text" style="text-align: center; color: #777777;">Tidak ada data penjualan untuk periode filter ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 4. SIGNATURE BLOCK -->
    <table>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" class="signature-title">KEPALA ADMINISTRASI DAN KEUANGAN,</td>
            <td>&nbsp;</td>
            <td colspan="2" class="signature-title">Mengetahui,<br>DIREKTUR,</td>
        </tr>
        <tr>
            <td colspan="7" style="height: 50px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Siti Kamariah, S.Pd.</td>
            <td>&nbsp;</td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Hj. NORMAULIDA, S.H.</td>
        </tr>
    </table>
</body>
</html>
