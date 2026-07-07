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
            <td colspan="11" class="header-title">LAPORAN DATA BARANG & INVENTARIS STOK - BAUNTUNGPOS</td>
        </tr>
        <tr>
            <td colspan="11" class="header-subtitle">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} - {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</td>
        </tr>
        <tr>
            <td colspan="11" class="header-address">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</td>
        </tr>
        <tr>
            <td colspan="11" style="text-align: center; font-size: 10px; color: #777777;">Tanggal Unduh: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</td>
        </tr>
        <tr>
            <td colspan="11">&nbsp;</td>
        </tr>
    </table>

    <!-- 2. TABLE DATA -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th class="table-header" style="width: 50px;">No.</th>
                <th class="table-header">Kode Barang</th>
                <th class="table-header">Nama Produk</th>
                <th class="table-header">Kategori</th>
                <th class="table-header">Satuan</th>
                <th class="table-header">Harga Modal (Rp)</th>
                <th class="table-header">Harga Jual (Rp)</th>
                <th class="table-header">Harga Grosir (Rp)</th>
                <th class="table-header">Min. Beli Grosir</th>
                <th class="table-header">Stok Fisik</th>
                <th class="table-header">Stok Minimum</th>
                <th class="table-header">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($products as $prod)
                <tr>
                    <td class="text" style="text-align: center;">{{ $no++ }}</td>
                    <td class="text" style="font-weight: bold;">{{ $prod->product_code }}</td>
                    <td class="text">{{ $prod->name }}</td>
                    <td class="text">{{ strtoupper($prod->category->name) }}</td>
                    <td class="text" style="text-align: center;">{{ $prod->unit }}</td>
                    <td class="number">{{ number_format($prod->buy_price, 0, ',', '.') }}</td>
                    <td class="number" style="font-weight: bold;">{{ number_format($prod->sell_price, 0, ',', '.') }}</td>
                    <td class="number" style="color: #10b981;">{{ $prod->wholesale_price ? number_format($prod->wholesale_price, 0, ',', '.') : '-' }}</td>
                    <td class="text" style="text-align: center;">{{ $prod->wholesale_min_qty ?: '-' }}</td>
                    <td class="number" style="font-weight: bold; {{ $prod->stock <= $prod->min_stock ? 'color: red;' : '' }}">{{ number_format($prod->stock, 0, ',', '.') }}</td>
                    <td class="number">{{ number_format($prod->min_stock, 0, ',', '.') }}</td>
                    <td class="text" style="text-align: center; font-weight: bold;">{{ $prod->is_active ? 'AKTIF' : 'NONAKTIF' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="12" class="text" style="text-align: center; color: #777777;">Belum ada data barang di dalam katalog produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 3. SIGNATURE BLOCK -->
    <table>
        <tr>
            <td colspan="11">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="11">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
            <td class="signature-title" colspan="3" style="text-align: center;">KEPALA ADMINISTRASI DAN KEUANGAN,</td>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="11" style="height: 50px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
            <td colspan="3" style="text-align: center; font-weight: bold; text-decoration: underline;">Siti Kamariah, S.Pd.</td>
            <td colspan="4">&nbsp;</td>
        </tr>
    </table>
</body>
</html>
