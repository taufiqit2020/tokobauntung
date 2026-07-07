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
            mso-number-format: "\@";
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
            <td colspan="7" class="header-title">LAPORAN PENYESUAIAN STOK OPNAME - BAUNTUNGPOS</td>
        </tr>
        <tr>
            <td colspan="7" class="header-subtitle">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} - {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</td>
        </tr>
        <tr>
            <td colspan="7" class="header-address">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</td>
        </tr>
        <tr>
            <td colspan="7" style="text-align: center; font-size: 10px; color: #777777;">Waktu Unduh: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
    </table>

    <!-- 2. RINCIAN STRUK TRANSAKSI -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th class="table-header">Tanggal & Waktu</th>
                <th class="table-header">Kode Barang</th>
                <th class="table-header">Nama Produk</th>
                <th class="table-header">Selisih Penyesuaian</th>
                <th class="table-header">Stok Akhir</th>
                <th class="table-header">Alasan Penyesuaian</th>
                <th class="table-header">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($opnameLogs as $log)
                <tr>
                    <td class="date">{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>
                    <td class="text" style="font-weight: bold; text-transform: uppercase;">{{ $log->product->product_code }}</td>
                    <td class="text">{{ $log->product->name }}</td>
                    <td class="text" style="text-align: right; color: {{ $log->qty_change > 0 ? '#10b981' : '#ef4444' }}; font-weight: bold;">
                        {{ $log->qty_change > 0 ? '+' : '' }}{{ number_format($log->qty_change, 0, ',', '.') }} {{ $log->product->unit }}
                    </td>
                    <td class="text" style="text-align: right; font-weight: bold;">
                        {{ number_format($log->current_stock, 0, ',', '.') }} {{ $log->product->unit }}
                    </td>
                    <td class="text">{{ $log->reason }}</td>
                    <td class="text">{{ $log->user->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text" style="text-align: center; color: #777777;">Belum ada riwayat stock opname yang tercatat.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 3. SIGNATURE BLOCK -->
    <table>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="7">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" class="signature-title">Mengetahui,<br>DIREKTUR,</td>
            <td>&nbsp;</td>
            <td colspan="2" class="signature-title">KEPALA ADMINISTRASI DAN KEUANGAN,</td>
        </tr>
        <tr>
            <td colspan="7" style="height: 50px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Hj. NORMAULIDA, S.H.</td>
            <td>&nbsp;</td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Siti Kamariah, S.Pd.</td>
        </tr>
    </table>
</body>
</html>
