<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pratinjau Laporan Pemasukan Es Teguk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            background: #f1f5f9;
            color: #1e293b;
            min-height: 100vh;
        }

        /* ============ TOP BAR ============ */
        .top-bar {
            background: #0f172a;
            color: white;
            padding: 14px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.3);
        }
        .top-bar-left { display: flex; align-items: center; gap: 12px; }
        .top-bar-left h1 { font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; }
        .top-bar-left p { font-size: 10px; color: #94a3b8; margin-top: 2px; }
        .top-bar-right { display: flex; gap: 10px; }

        .btn-back {
            background: none;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 6px;
            border-radius: 8px;
            transition: color 0.2s;
        }
        .btn-back:hover { color: white; }

        .btn-print {
            background: #4f46e5;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-print:hover { background: #4338ca; }

        .btn-excel {
            background: #059669;
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-excel:hover { background: #047857; }

        /* ============ PAPER CONTAINER ============ */
        .paper-wrap {
            padding: 30px 20px 50px;
            display: flex;
            justify-content: center;
        }

        .paper {
            background: white;
            width: 100%;
            max-width: 277mm;
            min-height: 190mm;
            padding: 30px 35px;
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0,0,0,0.12);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* ============ REPORT HEADER ============ */
        .report-header {
            text-align: center;
            padding-bottom: 16px;
            border-bottom: 2.5px solid #0f172a;
            margin-bottom: 18px;
        }
        .report-header h2 {
            font-size: 17px;
            font-weight: 800;
            text-transform: uppercase;
            color: #0f172a;
            letter-spacing: 0.06em;
        }
        .report-header h3 {
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            color: #374151;
            margin-top: 4px;
        }
        .report-header p {
            font-size: 10px;
            color: #6b7280;
            margin-top: 3px;
        }

        /* ============ SUMMARY CARDS ============ */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 18px;
        }
        .summary-card {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            background: #f8fafc;
        }
        .summary-card .label {
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #94a3b8;
            margin-bottom: 5px;
        }
        .summary-card .value {
            font-size: 15px;
            font-weight: 800;
        }
        .summary-card .value.green { color: #059669; }
        .summary-card .value.blue  { color: #2563eb; }
        .summary-card .value.dark  { color: #1e293b; }

        /* ============ TABLE ============ */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        thead tr {
            background: #1e293b;
            color: white;
        }
        thead th {
            padding: 9px 10px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            border: 1px solid #334155;
            text-align: left;
        }
        thead th.center { text-align: center; }
        thead th.right  { text-align: right; }

        tbody tr { border-bottom: 1px solid #e2e8f0; }
        tbody tr.even { background: #f8fafc; }
        tbody tr.odd  { background: #ffffff; }

        tbody td {
            padding: 8px 10px;
            border: 1px solid #e2e8f0;
            color: #374151;
            vertical-align: middle;
        }
        tbody td.center { text-align: center; color: #94a3b8; }
        tbody td.right  { text-align: right; font-weight: 700; color: #1e293b; }
        tbody td.nominal { text-align: right; font-weight: 800; color: #059669; }

        /* Column widths */
        .col-no    { width: 40px; }
        .col-date  { width: 90px; white-space: nowrap; }
        .col-desc  { width: auto; }
        .col-amt   { width: 130px; }
        .col-user  { width: 160px; }

        /* Total row */
        .total-row { background: #f1f5f9 !important; }
        .total-row td {
            font-weight: 800;
            font-size: 11px;
            color: #1e293b;
            border-color: #cbd5e1;
        }
        .total-row .total-label {
            text-align: right;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 10px;
        }
        .total-row .total-val {
            text-align: right;
            color: #059669;
            font-size: 13px;
        }

        /* ============ SIGNATURE BLOCK ============ */
        .signature-block {
            margin-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            text-align: center;
            gap: 20px;
        }
        .sig-col { padding: 0 24px; }
        .sig-title {
            font-size: 11px;
            font-weight: 700;
            color: #374151;
            line-height: 1.6;
        }
        .sig-space { height: 70px; }
        .sig-name {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            border-top: 1.5px solid #374151;
            padding-top: 6px;
            display: inline-block;
        }

        /* ============ PRINT OVERRIDES ============ */
        @media print {
            @page {
                size: A4 landscape;
                margin: 12mm 15mm;
            }
            .top-bar { display: none !important; }
            body { background: white !important; }
            .paper-wrap { padding: 0 !important; }
            .paper {
                box-shadow: none !important;
                border-radius: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
                padding: 0 !important;
                min-height: auto !important;
            }
            .summary-card { border: 1px solid #ccc !important; }
            table { width: 100% !important; font-size: 9pt !important; }
            thead th, tbody td { padding: 5pt 7pt !important; font-size: 9pt !important; }
            .signature-block { margin-top: 25mm !important; }
            .sig-space { height: 20mm !important; }
        }
    </style>
</head>
<body>

    {{-- ===== TOP BAR ===== --}}
    <div class="top-bar">
        <div class="top-bar-left">
            <button class="btn-back" onclick="window.close();">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="width:18px;height:18px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18"/>
                </svg>
            </button>
            <div>
                <h1>Pratinjau Laporan Pemasukan Es Teguk</h1>
                <p>Ukuran A4 Landscape &nbsp;·&nbsp; Printer Epson L311/L310</p>
            </div>
        </div>
        <div class="top-bar-right">
            <button class="btn-print" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:15px;height:15px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.258a1.791 1.791 0 0 1-1.764 2.117H7.874a1.791 1.791 0 0 1-1.764-2.117L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0-1.105-.895-2-2-2h-11c-1.105 0-2 .895-2 2M19.5 10.5a2.25 2.25 0 0 1 2.25 2.25v5.625a1.5 1.5 0 0 1-1.5 1.5h-1.5M19.5 10.5v3.75m-15-3.75a2.25 2.25 0 0 0-2.25 2.25v5.625a1.5 1.5 0 0 0 1.5 1.5h1.5M4.5 10.5v3.75m11.25-3.75h-7.5V3c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v6.75Z"/>
                </svg>
                Cetak Laporan
            </button>
            <a href="{{ $excelUrl }}" class="btn-excel">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:15px;height:15px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>
                </svg>
                Unduh Excel
            </a>
        </div>
    </div>

    {{-- ===== PAPER ===== --}}
    <div class="paper-wrap">
        <div class="paper">

            {{-- HEADER --}}
            <div>
                <div class="report-header">
                    <h2>LAPORAN PEMASUKAN ES TEGUK</h2>
                    <h3>{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} — {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</h3>
                    <p>{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</p>
                    <p>Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} &nbsp;·&nbsp; Dicetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</p>
                </div>

                {{-- SUMMARY CARDS --}}
                @php $grandTotal = $incomes->sum('amount'); @endphp
                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="label">Total Pemasukan Ditampilkan</div>
                        <div class="value green">Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card">
                        <div class="label">Total Pemasukan Bulan Ini</div>
                        <div class="value blue">Rp {{ number_format($totalIncomeThisMonth, 0, ',', '.') }}</div>
                    </div>
                    <div class="summary-card">
                        <div class="label">Jumlah Transaksi</div>
                        <div class="value dark">{{ count($incomes) }} transaksi</div>
                    </div>
                </div>

                {{-- TABLE --}}
                <table>
                    <thead>
                        <tr>
                            <th class="col-no center">No.</th>
                            <th class="col-date">Tanggal</th>
                            <th class="col-desc">Keterangan / Deskripsi</th>
                            <th class="col-amt right">Nominal (Rp)</th>
                            <th class="col-user">Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incomes as $inc)
                            <tr class="{{ $loop->even ? 'even' : 'odd' }}">
                                <td class="center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($inc->income_date)->format('d/m/Y') }}</td>
                                <td>{{ $inc->description ?: '-' }}</td>
                                <td class="nominal">Rp {{ number_format($inc->amount, 0, ',', '.') }}</td>
                                <td>{{ $inc->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:24px;color:#94a3b8;font-style:italic;">
                                    Belum ada catatan pemasukan Es Teguk untuk periode ini.
                                </td>
                            </tr>
                        @endforelse

                        @if(count($incomes) > 0)
                            <tr class="total-row">
                                <td colspan="3" class="total-label">TOTAL PEMASUKAN:</td>
                                <td class="total-val">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- SIGNATURE BLOCK --}}
            <div class="signature-block">
                <div class="sig-col">
                    <div class="sig-title">Kepala Administrasi dan Keuangan,</div>
                    <div class="sig-space"></div>
                    <div><span class="sig-name">Siti Kamariah, S.Pd.</span></div>
                </div>
                <div class="sig-col">
                    <div class="sig-title">Mengetahui,<br>Direktur,</div>
                    <div class="sig-space"></div>
                    <div><span class="sig-name">Hj. Normaulida, S.H.</span></div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>
