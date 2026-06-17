<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - BAUNTUNGPOS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                background-color: white !important;
            }
            .print-card {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
                width: 100% !important;
            }
            .print-container {
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen flex flex-col">

    <!-- Top Action Bar (Hidden when printing) -->
    <div class="no-print bg-slate-900 text-white py-4 px-6 shadow-md flex justify-between items-center sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <button onclick="window.close();" class="text-slate-400 hover:text-white transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
            </button>
            <div>
                <h1 class="font-bold text-sm uppercase tracking-wide">Pratinjau Cetak Laporan (A4)</h1>
                <p class="text-[10px] text-slate-400">Siap dicetak ke kertas A4 (Printer Epson L311/L310)</p>
            </div>
        </div>
        
        <div class="flex items-center space-x-3">
            <!-- Cetak Button -->
            <button onclick="window.print()" class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.258a1.791 1.791 0 0 1-1.764 2.117H7.874a1.791 1.791 0 0 1-1.764-2.117L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0-1.105-.895-2-2-2h-11c-1.105 0-2 .895-2 2M19.5 10.5a2.25 2.25 0 0 1 2.25 2.25v5.625a1.5 1.5 0 0 1-1.5 1.5h-1.5M19.5 10.5v3.75m-15-3.75a2.25 2.25 0 0 0-2.25 2.25v5.625a1.5 1.5 0 0 0 1.5 1.5h1.5M4.5 10.5v3.75m11.25-3.75h-7.5V3c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v6.75Z" />
                </svg>
                <span>Cetak Laporan</span>
            </button>
            
            <!-- Excel Download Button -->
            <a href="{{ $excelUrl }}" class="py-2 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                </svg>
                <span>Unduh Excel</span>
            </a>
        </div>
    </div>
    
    <!-- Printable Paper Sheet Container -->
    <div class="print-container flex-1 p-6 sm:p-12 overflow-x-auto">
        <div class="print-card w-full max-w-[210mm] min-h-[297mm] p-10 sm:p-12 mx-auto bg-white border border-slate-200 shadow-lg rounded-2xl flex flex-col justify-between">
            <div class="space-y-6">
                <!-- Header Laporan -->
                <div class="text-center space-y-1 pb-4 border-b-2 border-slate-900">
                    <h2 class="text-xl font-bold uppercase text-slate-900 tracking-wide">@yield('report_title')</h2>
                    <h3 class="text-sm font-semibold uppercase text-slate-700">{{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }} - {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}</h3>
                    <p class="text-xs text-slate-500 font-medium">{{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Komet, Banjarbaru') }}</p>
                    <p class="text-[10px] text-slate-400 font-medium">Waktu Unduh: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, H:mm') }} WITA</p>
                    @yield('report_meta')
                </div>

                <!-- Content Laporan -->
                <div class="text-xs">
                    @yield('report_content')
                </div>
            </div>

            <!-- Signature block -->
            <div class="mt-12 text-xs">
                <div class="grid grid-cols-2 text-center">
                    <div class="space-y-16">
                        <p class="font-bold tracking-wider text-slate-800">Kepala Administrasi dan Keuangan,</p>
                        <p class="font-bold underline text-slate-900">Siti Kamariah, S.Pd.</p>
                    </div>
                    <div class="space-y-16">
                        <p class="font-bold uppercase tracking-wider text-slate-800">Mengetahui,<br>Direktur,</p>
                        <p class="font-bold underline uppercase text-slate-900">Hj. Normaulida, S.H.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
