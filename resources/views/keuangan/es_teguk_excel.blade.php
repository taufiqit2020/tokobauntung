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
            mso-number-format: "yyyy\-mm\-dd";
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
            <td colspan="4" class="header-title">LAPORAN PEMASUKAN ES TEGUK - BAUNTUNGPOS</td>
        </tr>
        <tr>
            <td colspan="4" class="header-subtitle">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} - {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</td>
        </tr>
        <tr>
            <td colspan="4" class="header-address">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</td>
        </tr>
        <tr>
            <td colspan="5" style="text-align: center; font-size: 10px; color: #777777;">Periode: {{ $startDate->translatedFormat('d F Y') }} s/d {{ $endDate->translatedFormat('d F Y') }} · Dicetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
    </table>

    <!-- 2. RINGKASAN PEMASUKAN -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th colspan="2" class="table-header" style="background-color: #10b981; color: #ffffff;">RINGKASAN PEMASUKAN PERIODE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="stats-label">Total Pemasukan Periode Ini</td>
                <td class="stats-val" style="color: #10b981;">{{ number_format($totalIncomeThisMonth, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" style="font-weight: bold; font-size: 12px; text-decoration: underline;">RINCIAN PEMASUKAN ES TEGUK</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
    </table>

    <!-- 3. RINCIAN PEMASUKAN -->
    <table cellpadding="5" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th class="table-header">No.</th>
                <th class="table-header">Tanggal</th>
                <th class="table-header">Keterangan / Deskripsi</th>
                <th class="table-header">Nominal (Rp)</th>
                <th class="table-header">Petugas</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($incomes as $inc)
                @php $grandTotal += $inc->amount; @endphp
                <tr>
                    <td class="text" style="text-align:center;">{{ $loop->iteration }}</td>
                    <td class="date">{{ $inc->income_date }}</td>
                    <td class="text">{{ $inc->description ?: '-' }}</td>
                    <td class="number">{{ number_format($inc->amount, 0, ',', '.') }}</td>
                    <td class="text">{{ $inc->user->name }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text" style="text-align: center; color: #777777;">Belum ada catatan pemasukan Es Teguk.</td>
                </tr>
            @endforelse
            @if(count($incomes) > 0)
                <tr style="font-weight: bold; background-color: #f9fafb;">
                    <td colspan="3" class="text" style="text-align: right; font-weight: bold;">TOTAL PEMASUKAN:</td>
                    <td class="number" style="color: #10b981; font-weight: bold;">{{ number_format($grandTotal, 0, ',', '.') }}</td>
                    <td class="text">&nbsp;</td>
                </tr>
            @endif
        </tbody>
    </table>

    <!-- 4. SIGNATURE BLOCK -->
    <table>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
            <td class="signature-title" colspan="2">KEPALA ADMINISTRASI DAN KEUANGAN,</td>
            <td class="signature-title" colspan="2">Mengetahui,<br>DIREKTUR,</td>
        </tr>
        <tr>
            <td colspan="4" style="height: 50px;">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Siti Kamariah, S.Pd.</td>
            <td colspan="2" style="text-align: center; font-weight: bold; text-decoration: underline;">Hj. NORMAULIDA, S.H.</td>
        </tr>
    </table>
</body>
</html>
