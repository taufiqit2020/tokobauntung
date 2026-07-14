<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - BAUNTUNGPOS</title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0f172a">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            user-select: none;
        }
        /* Hide scrollbars for layouts */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .receipt-paper {
            font-family: 'Courier New', Courier, monospace;
            background-color: #fbfbfb;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1), inset 0 0 10px rgba(0,0,0,0.05);
            background-image: repeating-linear-gradient(#f0f0f0, #f0f0f0 1px, transparent 1px, transparent 24px);
        }
        @media print {
            body * { visibility: hidden; }
            #receipt-paper, #receipt-paper * { visibility: visible; }
            #receipt-paper {
                position: absolute;
                left: 0;
                top: 0;
                width: 58mm;
                margin: 0;
                padding: 0;
                box-shadow: none;
                border: none;
                background-image: none;
                background-color: transparent;
                color: #000;
            }
            @page { size: 58mm auto; margin: 0; }
        }
    </style>
</head>
<body class="bg-white text-slate-800 h-full overflow-hidden flex flex-col">

    <!-- Offline Notification Banner -->
    <div id="offline-banner" class="bg-amber-600 text-white py-1 px-4 text-center text-xs font-bold uppercase tracking-wider hidden animate-bounce z-50">
        ⚠️ Mode Offline Aktif: Hanya menerima pembayaran TUNAI. Transaksi akan disimpan lokal & disinkronkan setelah online.
    </div>

    <!-- Check if Active Shift Exists -->
    @if(!$activeShift)
    <!-- LOCK SCREEN: Start Shift Modal -->
    <div class="fixed inset-0 bg-slate-900/95 flex justify-center items-center z-50 p-4">
        <!-- Floating shapes -->
        <div class="absolute w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl -top-20 -left-20"></div>
        <div class="absolute w-96 h-96 rounded-full bg-purple-500/10 blur-3xl -bottom-20 -right-20"></div>

        <div class="bg-slate-800 border border-slate-700/50 rounded-2xl p-8 max-w-md w-full shadow-2xl z-10">
            <div class="text-center mb-6">
                <div class="inline-flex p-3 bg-indigo-500/10 text-indigo-400 rounded-xl mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white tracking-tight">Selamat Datang!</h1>
                <p class="text-slate-400 text-xs mt-1 uppercase tracking-wider">Mulai Shift Baru untuk Transaksi</p>
            </div>

            <!-- Login User Info -->
            <div class="flex items-center space-x-3 bg-slate-700/30 rounded-xl p-3 mb-5 border border-slate-700">
                <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white uppercase text-sm">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-white">Kasir: {{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-indigo-400 uppercase tracking-wider font-semibold">Siap Melayani</p>
                </div>
            </div>

            <form action="{{ route('pos.shift.open') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Modal Awal Laci (Starting Cash)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-semibold text-sm">Rp</span>
                        <input type="number" name="starting_cash" value="100000" min="0" required
                               class="block w-full pl-10 pr-3 py-3 bg-slate-700/50 border border-slate-600 rounded-xl text-slate-100 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all text-base font-bold"
                               placeholder="Contoh: 100000">
                    </div>
                </div>

                <div class="flex flex-col mt-6 space-y-3">
                    <button type="submit"
                            class="w-full py-4 px-4 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-500/20 transition-all text-base active:scale-95 cursor-pointer text-center">
                        Buka Shift & Mulai Transaksi
                    </button>
                    <button type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="w-full py-2 text-slate-400 hover:text-slate-300 font-medium transition-all text-sm cursor-pointer text-center underline">
                        Bukan {{ Auth::user()->name }}? Ganti Akun (Logout)
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- Main Header -->
    <header class="bg-slate-900 text-white h-16 px-4 flex items-center justify-between shrink-0 shadow-md">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="p-1.5 bg-indigo-600 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <div>
                <span class="font-bold tracking-tight text-white block leading-none">BAUNTUNGPOS</span>
                <span class="text-[9px] text-indigo-400 font-semibold tracking-widest uppercase">Toko Plastik & Sembako</span>
            </div>
        </div>

        <!-- Connection / Cashier Info -->
        <div class="flex items-center space-x-6">
            <!-- Connection Status -->
            <div class="flex items-center space-x-2">
                <span id="status-dot" class="w-3 h-3 bg-emerald-500 rounded-full animate-ping"></span>
                <span id="status-text" class="text-xs font-bold text-slate-400 uppercase tracking-wider">Online</span>
            </div>

            <div class="h-6 w-[1px] bg-slate-800"></div>

            <!-- Active Shift / User -->
            <div class="flex items-center space-x-3">
                <div class="text-right">
                    <p class="text-xs font-bold text-white">{{ Auth::user()->name }}</p>
                    <p class="text-[9px] text-slate-400">Shift modal: Rp {{ $activeShift ? number_format($activeShift->starting_cash, 0, ',', '.') : '0' }}</p>
                </div>
                <div class="w-8 h-8 rounded-full bg-slate-800 border border-slate-700 flex items-center justify-center font-bold text-indigo-400 uppercase text-xs">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
            </div>

            <div class="h-6 w-[1px] bg-slate-800"></div>

            <!-- Logout / Shift Close -->
            <div class="flex items-center space-x-2">
                @if($activeShift)
                <button onclick="openCloseShiftModal()"
                        class="py-1.5 px-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-lg text-xs tracking-wide cursor-pointer transition-all">
                    Tutup Shift
                </button>
                @endif
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="py-1.5 px-3 bg-slate-700 hover:bg-slate-600 text-slate-300 font-bold rounded-lg text-xs tracking-wide cursor-pointer transition-all">
                    Logout
                </button>
            </div>
        </div>
    </header>

    <!-- Main Workspace -->
    <div class="flex-1 flex overflow-hidden">
        
        <!-- Left Pane: Catalog & Search (60% width) -->
        <div class="w-7/12 flex flex-col p-4 overflow-hidden border-r border-slate-200 bg-white">
            <!-- Search Product Code Input -->
            <div class="mb-4">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                        </svg>
                    </span>
                    <input type="text" id="barcode-input"
                           class="w-full pl-11 pr-32 py-3 bg-slate-100 border border-slate-200 rounded-2xl shadow-sm text-slate-900 font-bold focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-400 text-sm"
                           placeholder="Ketik KODE BARANG (Enter) atau cari nama produk..."
                           oninput="toggleClearSearchButton(); renderProducts()"
                           onkeydown="handleBarcodeKeydown(event)">
                    <button type="button" id="clear-search-btn" onclick="clearSearchInput()"
                            class="absolute right-[85px] top-2 text-slate-500 hover:text-slate-700 bg-slate-200 hover:bg-slate-300 transition-all cursor-pointer hidden w-7 h-7 rounded-full pt-1.5 pl-1.5 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <span class="absolute right-3 top-2.5 px-2 py-1 bg-indigo-50 text-indigo-700 text-[10px] font-bold uppercase rounded border border-indigo-100 whitespace-nowrap">
                        F2 Focus
                    </span>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div id="category-tabs-container" class="flex space-x-2 mb-4 overflow-x-auto no-scrollbar shrink-0">
                <button onclick="filterCategory('all')" id="cat-tab-all"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-indigo-600/10 shrink-0 cursor-pointer uppercase">
                    Semua
                </button>
                @foreach($categories as $cat)
                <button onclick="filterCategory('{{ $cat->id }}')" id="cat-tab-{{ $cat->id }}"
                        class="px-4 py-2 bg-slate-100 text-slate-650 border border-slate-200 hover:bg-slate-200 rounded-xl text-xs font-bold transition-all shrink-0 cursor-pointer uppercase">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>

            <!-- Product Grid -->
            <div class="flex-1 overflow-y-auto no-scrollbar pb-6">
                <div id="product-grid" class="grid grid-cols-3 gap-3">
                    <!-- Products will be generated here by Javascript -->
                </div>
            </div>
        </div>
        <div class="w-5/12 bg-gradient-to-br from-amber-50 via-yellow-50 to-orange-100 flex flex-col overflow-hidden shadow-inner border-l border-amber-200 text-slate-900">
            <!-- Cart Header -->
            <div class="p-4 border-b border-amber-200 flex justify-between items-center bg-white/40 shrink-0 shadow-sm">
                <h3 class="font-bold text-slate-800 text-sm flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-amber-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span>KERANJANG BELANJA</span>
                </h3>
                <button onclick="clearCart()" class="text-rose-600 hover:text-rose-700 text-xs font-bold tracking-wide uppercase transition-all cursor-pointer flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                    <span>Bersihkan</span>
                </button>
            </div>

            <!-- Cart Items List -->
            <div id="cart-list" class="flex-1 overflow-y-auto p-4 space-y-3 no-scrollbar">
                <!-- Cart items generated by Javascript -->
                <div id="empty-cart-view" class="h-full flex flex-col justify-center items-center text-amber-700 py-12 opacity-80">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16 text-amber-400 mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    <p class="font-semibold text-sm text-amber-700">Keranjang Belanja Kosong</p>
                    <p class="text-xs text-amber-600 mt-1">Ketik Kode Barang di atas atau sentuh produk di sebelah kiri</p>
                </div>
            </div>
            <!-- Cart Footer / Summaries & Payments -->
            <div class="p-4 border-t border-amber-200 bg-white/40 shrink-0 space-y-4 text-slate-900 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.02)]">
                <!-- Quick Totals -->
                <div class="space-y-1.5">
                    <div class="flex justify-between text-slate-700 text-xs">
                        <span>Subtotal:</span>
                        <span id="sum-subtotal" class="text-slate-900 font-bold">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-700 text-xs">
                        <span>Potongan Grosir:</span>
                        <div class="flex items-center space-x-1">
                            <span class="text-rose-600 font-bold" id="sum-discount">- Rp 0</span>
                            <button onclick="openDiscountModal()" class="text-indigo-700 hover:text-indigo-800 font-bold hover:underline cursor-pointer">
                                [Ubah]
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-between text-slate-900 font-extrabold text-lg border-t border-amber-200/50 pt-2">
                        <span>GRAND TOTAL:</span>
                        <span class="text-indigo-700" id="sum-grandtotal">Rp 0</span>
                    </div>
                </div>
 
                <!-- Action buttons -->
                <div class="flex space-x-3">
                    <button onclick="handleHoldTransaction()"
                            class="w-1/3 py-3 px-3 bg-white hover:bg-slate-50 text-slate-800 font-bold rounded-xl text-xs uppercase tracking-wide transition-all active:scale-95 cursor-pointer flex items-center justify-center space-x-1.5 shadow-sm border border-amber-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25v13.5m-7.5-13.5v13.5" />
                        </svg>
                        <span>Hold (F8)</span>
                    </button>
                    <button onclick="openPaymentModal()" id="btn-pay" disabled
                            class="w-2/3 py-3 px-4 bg-amber-200 text-amber-600 font-bold rounded-xl text-sm uppercase tracking-wider transition-all flex items-center justify-center space-x-2 border border-amber-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15/5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                        </svg>
                        <span>BAYAR (F9)</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MOCK PRINTER SIMULATOR SIDEBAR (Slide-over panel) -->
    <div id="printer-panel" class="fixed inset-y-0 right-0 w-80 bg-slate-800 border-l border-slate-700 z-50 transform translate-x-full transition-transform duration-300 ease-out shadow-2xl flex flex-col">
        <!-- Header -->
        <div class="p-4 border-b border-slate-700 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="font-bold text-xs uppercase tracking-wider flex items-center space-x-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-ping"></span>
                <span>Thermal Printer 58mm Simulator</span>
            </h3>
            <button onclick="togglePrinterPanel()" class="text-slate-400 hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <!-- Print Screen / Output -->
        <div class="flex-1 p-6 overflow-y-auto no-scrollbar flex flex-col justify-start items-center bg-slate-900">
            <!-- Simulated paper receipt -->
            <div id="receipt-paper" class="receipt-paper bg-white w-max mx-auto px-5 py-6 text-[10px] font-mono text-slate-900 leading-snug border border-slate-300 whitespace-pre shadow-xl min-h-[350px] transition-all duration-700 transform translate-y-4 opacity-0">
                <!-- Receipt raw text injected here -->
            </div>
        </div>

        <!-- Print Actions -->
        <div class="p-4 border-t border-slate-700 bg-slate-950 flex flex-col space-y-2">
            <button onclick="printViaThermer()" class="py-2.5 px-4 bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-bold rounded-lg uppercase tracking-wide cursor-pointer transition-all active:scale-95 text-center flex items-center justify-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" /></svg>
                <span>Cetak Struk</span>
            </button>
        </div>
    </div>
        <!-- MODAL: Close Shift Modal -->
    <div id="close-shift-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-md w-full shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800 text-lg uppercase">Tutup Shift Kasir</h3>
                <button onclick="closeCloseShiftModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
 
            <form action="{{ route('pos.shift.close') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Total Uang Tunai Fisik di Laci</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                        <input type="number" name="actual_cash" required min="0"
                               class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all font-bold text-lg"
                               placeholder="Hitung jumlah uang fisik di laci...">
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Sistem akan membandingkan jumlah ini dengan ekspektasi sistem untuk menghitung selisih (variance).</p>
                </div>
 
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Catatan Shift (Opsional)</label>
                    <textarea name="note" rows="2"
                              class="block w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-rose-500 transition-all text-xs"
                              placeholder="Tulis kendala laci kas atau alasan jika ada selisih..."></textarea>
                </div>
 
                <div class="flex space-x-3 pt-4 border-t border-slate-100">
                    <button type="button" onclick="closeCloseShiftModal()"
                            class="flex-1 py-3 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-sm transition-all cursor-pointer text-center">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 py-3 px-4 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl text-sm shadow-lg shadow-rose-600/20 transition-all active:scale-95 cursor-pointer text-center">
                        Tutup Shift & Log
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL: Custom Discount Transaction -->
    <div id="discount-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
        <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-sm w-full shadow-2xl">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-slate-800 text-sm uppercase">Atur Potongan Grosir</h3>
                <button onclick="closeDiscountModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
 
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Nilai Potongan (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 font-bold text-sm">Rp</span>
                        <input type="number" id="input-discount-nominal" value="0" min="0"
                               class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold text-base">
                    </div>
                </div>
 
                <div class="flex space-x-3 pt-4">
                    <button onclick="closeDiscountModal()"
                            class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-650 font-bold rounded-xl text-xs transition-all cursor-pointer text-center">
                        Batal
                    </button>
                    <button onclick="applyDiscount()"
                            class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer text-center">
                        Terapkan
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL: Payment Screen (F9) -->
    <div id="payment-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
        <div class="bg-white border border-slate-200 rounded-3xl p-6 max-w-2xl w-full shadow-2xl flex flex-col max-h-[90%] overflow-hidden">
            <!-- Modal Header -->
            <div class="flex justify-between items-center pb-4 border-b border-slate-100 shrink-0">
                <h3 class="font-bold text-slate-800 text-base uppercase">Metode & Proses Pembayaran</h3>
                <button onclick="closePaymentModal()" class="text-slate-400 hover:text-slate-650 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
 
            <!-- Modal Content (Scrollable if needed) -->
            <div class="flex-1 overflow-y-auto py-6 flex flex-col md:flex-row gap-6 no-scrollbar">
                
                <!-- Left Column: Payment Details & Choices -->
                <div class="flex-1 space-y-5">
                    <!-- Invoice summary -->
                    <div class="bg-slate-50 border border-slate-200/50 rounded-2xl p-4">
                        <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Tagihan Belanja</p>
                        <p class="text-3xl font-extrabold text-indigo-600 mt-1" id="pay-grand-total">Rp 0</p>
                    </div>

                    <!-- Payment methods tabs -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2.5">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-2 gap-3">
                            <button onclick="selectPaymentMethod('cash')" id="btn-pay-cash"
                                    class="py-4 px-4 bg-indigo-50 border-2 border-indigo-600 text-indigo-700 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15M5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                                </svg>
                                <span class="text-sm uppercase tracking-wide">Cash / Tunai</span>
                            </button>
                            <button onclick="selectPaymentMethod('qris')" id="btn-pay-qris"
                                    class="py-4 px-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all hover:bg-slate-50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5zM13.5 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5z" />
                                </svg>
                                <span class="text-sm uppercase tracking-wide">QRIS Digital</span>
                            </button>
                        </div>
                    </div>
                </div>
 
                <!-- Right Column: Interactive inputs (Cash / QRIS specific views) -->
                <div class="flex-1 border-t md:border-t-0 md:border-l border-slate-100 pt-6 md:pt-0 md:pl-6 flex flex-col justify-between">
                    
                    <!-- CASH PAYMENT SECTION -->
                    <div id="payment-cash-view" class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Uang Diterima (Rp)</label>
                            <input type="number" id="input-cash-amount" value="0" min="0" oninput="calculateChange()"
                                   class="block w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold text-xl placeholder-slate-400"
                                   placeholder="Masukkan jumlah uang...">
                        </div>

                        <!-- Quick Cash Buttons -->
                        <div>
                            <label class="block text-[10px] font-semibold text-slate-400 uppercase tracking-wider mb-2">Tombol Cepat</label>
                            <div class="grid grid-cols-3 gap-2" id="quick-cash-grid">
                                <!-- Denominations injected here by Javascript -->
                            </div>
                        </div>

                        <!-- Change Due -->
                        <div class="p-3 bg-slate-50 border border-slate-200/50 rounded-xl flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-semibold">UANG KEMBALIAN:</span>
                            <span id="cash-change-due" class="font-extrabold text-lg text-slate-800">Rp 0</span>
                        </div>
                    </div>

                    <!-- QRIS PAYMENT SECTION (Hidden initially) -->
                    <div id="payment-qris-view" class="space-y-4 hidden flex-col items-center text-center">
                        <div class="p-2 bg-white border border-slate-200 rounded-2xl shadow-sm inline-block">
                            <img id="qris-image-placeholder" src="/images/qris-bauntung.jpg" alt="QRIS Toko Sembako Plastik Bauntung" class="w-48 h-auto rounded-lg">
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-sm">QRIS DINAMIS BAUNTUNG</p>
                            <p class="text-xs text-slate-500 mt-1 max-w-[280px]">Silakan arahkan pembeli untuk men-scan QR di atas. Nominal harga akan otomatis terdeteksi.</p>
                        </div>
                    </div>
                    
                </div>
            </div>
 
            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex flex-col space-y-3 shrink-0">
                <div class="flex items-center justify-end">
                    <label class="flex items-center space-x-2 cursor-pointer text-slate-600 font-bold text-xs uppercase tracking-wide bg-indigo-50 px-3 py-1.5 rounded-lg border border-indigo-100">
                        <input type="checkbox" id="auto-print-checkbox" class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500" checked>
                        <span>Langsung Cetak Struk Setelah Pembayaran Berhasil</span>
                    </label>
                </div>
                <div class="flex space-x-3 w-full">
                    <button type="button" onclick="closePaymentModal()"
                            class="flex-1 py-3.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-2xl text-sm transition-all cursor-pointer text-center">
                        Batal
                    </button>
                    <button type="button" onclick="submitTransaction()" id="btn-submit-trans" disabled
                            class="flex-1 py-3.5 px-4 bg-slate-300 text-slate-500 font-bold rounded-2xl text-sm transition-all shadow-md text-center flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                        <span>Selesaikan Transaksi</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL: Transaction Success -->
    <div id="success-modal" class="fixed inset-0 bg-slate-900/90 justify-center items-center z-50 p-4 hidden">
        <div class="bg-white rounded-3xl w-full max-w-sm flex flex-col overflow-hidden shadow-2xl transform scale-100 transition-all">
            <!-- Header -->
            <div class="bg-emerald-500 p-5 text-center shrink-0">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-emerald-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white tracking-tight">Pembayaran Sukses!</h2>
                <p id="success-modal-amount-paid" class="text-white text-base font-extrabold mt-2 bg-emerald-600/35 px-4 py-1.5 rounded-full border border-emerald-400/30 inline-block">Rp 0</p>
                <p class="text-emerald-100 text-[10px] opacity-75 mt-0.5">Transaksi telah tersimpan</p>
            </div>
            
            <!-- Receipt Preview Area -->
            <div class="bg-slate-100 p-4 shrink-0 border-b border-slate-200">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider text-center mb-2">Pratinjau Struk</p>
                <div class="h-48 overflow-y-auto bg-white border border-slate-300 p-3 shadow-inner no-scrollbar">
                    <pre id="success-receipt-preview" class="text-[9px] font-mono text-slate-800 whitespace-pre-wrap leading-tight mx-auto w-max"></pre>
                </div>
            </div>

            <!-- Actions -->
            <div class="p-5 flex flex-col space-y-3 bg-white shrink-0">
                <button onclick="printViaThermerModal()" class="w-full py-3.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-sm uppercase tracking-wide transition-all shadow-md shadow-indigo-600/20 active:scale-95 flex justify-center items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0v-2.818c0-.66.53-1.196 1.189-1.255a49.19 49.19 0 0 1 8.122 0c.66.059 1.189.596 1.189 1.255v2.818Z" />
                    </svg>
                    <span>Cetak Struk</span>
                </button>
                <button onclick="closeSuccessModal()" class="w-full py-3 px-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl text-sm uppercase tracking-wide transition-all mt-2 active:scale-95">
                    SELESAI
                </button>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script>
        // Global variables passed from server
        let categoriesData = @json($categories);
        let productsData = @json($products);
        const shopSettings = @json($shopSettings);
        const csrfToken = '{{ csrf_token() }}';
        
        let currentCategoryFilter = 'all';
        let cart = [];
        let transactionDiscount = 0;
        let selectedPaymentMethod = 'cash'; // 'cash' or 'qris'
        let hasActiveShift = @json($activeShift ? true : false);

        document.addEventListener('DOMContentLoaded', () => {
            renderCategoryTabs();
            renderProducts();
            updateCartUI();
            checkOfflineStatus();
            
            // Listen to connection changes
            window.addEventListener('online', syncOfflineQueue);
            window.addEventListener('offline', checkOfflineStatus);
            
            // Start background sync every 5 seconds
            setInterval(syncPOSData, 5000);
            
            // Focus barcode input initially if shift is open (Disabled as requested)
            // if (hasActiveShift) {
            //     focusBarcodeInput();
            // }

            // Global shortcut handler
            window.addEventListener('keydown', (e) => {
                // Auto-focus barcode-input if user types a printable key and not focused on input elements
                if (!e.ctrlKey && !e.altKey && !e.metaKey) {
                    const active = document.activeElement;
                    const isInput = active && (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA' || active.tagName === 'SELECT');
                    if (!isInput && e.key.length === 1 && !e.key.match(/[\r\n\t]/)) {
                        const input = document.getElementById('barcode-input');
                        if (input) {
                            input.focus();
                        }
                    }
                }

                if (e.key === 'F2') {
                    e.preventDefault();
                    focusBarcodeInput();
                } else if (e.key === 'F8') {
                    e.preventDefault();
                    handleHoldTransaction();
                } else if (e.key === 'F9') {
                    e.preventDefault();
                    if (cart.length > 0 && hasActiveShift) {
                        openPaymentModal();
                    }
                }
            });
        });

        // Focus Barcode Column
        function focusBarcodeInput() {
            const input = document.getElementById('barcode-input');
            if (input) {
                input.focus();
                input.select();
            }
        }

        // Clear Search Input
        function clearSearchInput() {
            const input = document.getElementById('barcode-input');
            if (input) {
                input.value = '';
                toggleClearSearchButton();
                renderProducts();
                input.focus();
            }
        }

        // Toggle visibility of clear button
        function toggleClearSearchButton() {
            const input = document.getElementById('barcode-input');
            const btn = document.getElementById('clear-search-btn');
            if (input && btn) {
                if (input.value.length > 0) {
                    btn.classList.remove('hidden');
                } else {
                    btn.classList.add('hidden');
                }
            }
        }

        // Render products based on search & category
        function renderProducts() {
            const grid = document.getElementById('product-grid');
            if (!grid) return;
            grid.innerHTML = '';

            const searchInput = document.getElementById('barcode-input').value.toLowerCase();
            
            const filteredProducts = productsData.filter(prod => {
                // Category match
                if (currentCategoryFilter !== 'all' && prod.category_id != currentCategoryFilter) {
                    return false;
                }
                // Search query match
                if (searchInput) {
                    return prod.product_code.toLowerCase().includes(searchInput) || 
                           prod.name.toLowerCase().includes(searchInput);
                }
                return true;
            });

            if (filteredProducts.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-3 py-12 text-center text-slate-400 text-sm">
                        Produk tidak ditemukan.
                    </div>
                `;
                return;
            }
            filteredProducts.forEach(prod => {
                const isLowStock = prod.stock <= prod.min_stock;
                const card = document.createElement('div');
                card.onclick = () => addToCart(prod.id);
                card.className = `bg-slate-300 border ${isLowStock ? 'border-amber-500 bg-amber-50' : 'border-slate-400/80'} hover:border-indigo-650 rounded-2xl p-4 shadow-sm hover:shadow-md transition-all cursor-pointer flex flex-col justify-between space-y-3 relative overflow-hidden active:scale-95 duration-700`;
                
                // If low stock, show amber indicator
                if (isLowStock) {
                    card.innerHTML += `
                        <div class="absolute top-0 right-0 bg-amber-500 text-white text-[8px] font-bold px-2 py-0.5 uppercase rounded-bl">
                            Stok Tipis
                        </div>
                    `;
                }
 
                card.innerHTML += `
                    <div>
                        <span class="text-[10px] font-bold text-slate-500 block tracking-wide uppercase">${prod.product_code}</span>
                        <h4 class="font-bold text-slate-900 text-sm mt-0.5 break-words whitespace-normal">${prod.name}</h4>
                    </div>
                    <div class="flex justify-between items-end">
                        <div>
                            <span class="text-xs text-slate-600 block">Stok: <strong class="${isLowStock ? 'text-amber-700' : 'text-slate-700'}">${prod.stock} ${prod.unit}</strong></span>
                            <span class="font-extrabold text-blue-600 text-sm">Rp ${numberFormat(prod.sell_price)}</span>
                            ${prod.wholesale_price ? '<span class="text-[10px] text-emerald-600 block font-bold mt-0.5">Grosir: Rp ' + numberFormat(prod.wholesale_price) + ' (Min. ' + prod.wholesale_min_qty + ')</span>' : ''}
                        </div>
                        <div class="p-1 bg-slate-450/20 text-slate-800 rounded-lg hover:bg-indigo-600 hover:text-white transition-all border border-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </div>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        // Category filter trigger
        function filterCategory(catId) {
            currentCategoryFilter = catId;
            
            // Update tabs UI
            document.querySelectorAll('[id^="cat-tab-"]').forEach(btn => {
                btn.className = "px-4 py-2 bg-slate-100 text-slate-650 border border-slate-200 hover:bg-slate-200 rounded-xl text-xs font-bold transition-all shrink-0 cursor-pointer uppercase";
            });
            
            const activeTab = document.getElementById(`cat-tab-${catId}`);
            if (activeTab) {
                activeTab.className = "px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-indigo-600/10 shrink-0 cursor-pointer uppercase";
            }
            
            renderProducts();
        }

        // Keyboard search & barcode matching (F2 Focus)
        function handleBarcodeKeydown(event) {
            if (event.key === 'Enter') {
                const val = event.target.value.trim().toUpperCase();
                if (val) {
                    // Cek jika ada kecocokan KODE BARANG persis
                    const matchedProd = productsData.find(p => p.product_code.toUpperCase() === val);
                    if (matchedProd) {
                        addToCart(matchedProd.id);
                        event.target.value = ''; // Clear input
                        toggleClearSearchButton();
                    }
                }
                renderProducts();
            } else if (event.key === 'Escape') {
                event.target.value = '';
                toggleClearSearchButton();
                renderProducts();
            }
        }

        // Add to Cart logic
        function addToCart(productId) {
            if (!hasActiveShift) {
                alert('Silakan buka shift kasir terlebih dahulu!');
                return;
            }

            const product = productsData.find(p => p.id === productId);
            if (!product) return;

            // Check if stock is 0
            if (product.stock <= 0) {
                alert('Stok barang habis!');
                return;
            }

            const existingCartItem = cart.find(item => item.id === productId);
            if (existingCartItem) {
                if (existingCartItem.qty >= product.stock) {
                    alert('Tidak bisa menambah barang. Jumlah melebihi stok yang tersedia!');
                    return;
                }
                existingCartItem.qty++;
            } else {
                cart.push({
                    id: product.id,
                    product_code: product.product_code,
                    name: product.name,
                    unit: product.unit,
                    sell_price: parseFloat(product.sell_price),
                    buy_price: parseFloat(product.buy_price),
                    qty: 1,
                    discount: 0
                });
            }

            updateCartUI();
        }

        // Adjust Qty
        function adjustQty(productId, amount) {
            const item = cart.find(i => i.id === productId);
            const product = productsData.find(p => p.id === productId);
            if (!item || !product) return;

            item.qty += amount;
            if (item.qty <= 0) {
                removeFromCart(productId);
            } else if (item.qty > product.stock) {
                alert('Stok tidak mencukupi!');
                item.qty = product.stock;
            }

            updateCartUI();
        }

        // Remove item
        function removeFromCart(productId) {
            cart = cart.filter(i => i.id !== productId);
            updateCartUI();
        }

        // Clear cart
        function clearCart() {
            if (cart.length === 0) return;
            if (confirm('Apakah Anda yakin ingin mematikan transaksi ini?')) {
                cart = [];
                transactionDiscount = 0;
                updateCartUI();
            }
        }

        // Update Cart DOM
        function updateCartUI() {
            const list = document.getElementById('cart-list');
            const emptyView = document.getElementById('empty-cart-view');
            const btnPay = document.getElementById('btn-pay');
            
            if (!list) return;
            list.querySelectorAll('.cart-item-row').forEach(row => row.remove());

            if (cart.length === 0) {
                emptyView.classList.remove('hidden');
                btnPay.disabled = true;
                btnPay.className = "w-2/3 py-3 px-4 bg-amber-200 text-amber-600 font-bold rounded-xl text-sm uppercase tracking-wider transition-all shadow-md flex items-center justify-center space-x-2 border border-amber-300";
                
                document.getElementById('sum-subtotal').innerText = 'Rp 0';
                document.getElementById('sum-discount').innerText = '- Rp 0';
                document.getElementById('sum-grandtotal').innerText = 'Rp 0';
                return;
            }

            emptyView.classList.add('hidden');
            btnPay.disabled = false;
            btnPay.className = "w-2/3 py-3 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-xl text-sm uppercase tracking-wider transition-all shadow-lg shadow-emerald-500/20 active:scale-95 cursor-pointer flex items-center justify-center space-x-2";

            let subtotal = 0;

            cart.forEach(item => {
                const product = productsData.find(p => p.id === item.id);
                
                // Determine active price (grosir vs eceran)
                let activePrice = parseFloat(product.sell_price);
                let isWholesaleApplied = false;
                
                if (product && product.wholesale_price && product.wholesale_min_qty && item.qty >= product.wholesale_min_qty) {
                    activePrice = parseFloat(product.wholesale_price);
                    isWholesaleApplied = true;
                }
                
                // Update item sell_price object property to sync with database store
                item.sell_price = activePrice;

                const itemSubtotal = (activePrice - item.discount) * item.qty;
                subtotal += itemSubtotal;

                const row = document.createElement('div');
                row.className = 'cart-item-row bg-white/60 border border-amber-200 rounded-xl p-3 flex justify-between items-center space-x-3 text-slate-900 shadow-sm';
                row.innerHTML = `
                    <div class="flex-1 min-w-0">
                        <span class="text-[9px] font-bold text-slate-500 tracking-wide block uppercase">${item.product_code}</span>
                        <h4 class="font-bold text-slate-900 text-xs break-words whitespace-normal mt-0.5">${item.name}</h4>
                        <div class="flex flex-wrap items-center gap-1.5 mt-0.5">
                            <span class="text-xs ${isWholesaleApplied ? 'text-emerald-600 font-extrabold' : 'text-indigo-700 font-bold'}">
                                Rp ${numberFormat(activePrice)} / ${item.unit}
                            </span>
                            ${isWholesaleApplied ? '<span class="px-1.5 py-0.5 bg-emerald-50 text-emerald-700 text-[8px] font-bold uppercase rounded border border-emerald-100">Grosir</span>' : ''}
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 shrink-0">
                        <!-- Plus/Minus counter -->
                        <div class="flex items-center bg-white border border-slate-200 rounded-lg p-0.5 shadow-sm text-slate-800">
                            <button onclick="adjustQty(${item.id}, -1)" class="w-6 h-6 flex items-center justify-center text-slate-500 hover:text-rose-600 hover:bg-rose-50 rounded font-bold cursor-pointer">-</button>
                            <span class="w-8 text-center text-xs font-bold text-slate-900">${item.qty}</span>
                            <button onclick="adjustQty(${item.id}, 1)" class="w-6 h-6 flex items-center justify-center text-slate-500 hover:text-indigo-600 hover:bg-indigo-50 rounded font-bold cursor-pointer">+</button>
                        </div>
                        
                        <!-- Item subtotal -->
                        <span class="min-w-[80px] text-right font-extrabold text-xs text-slate-900 whitespace-nowrap">Rp ${numberFormat(itemSubtotal)}</span>

                        <!-- Delete button -->
                        <button onclick="removeFromCart(${item.id})" class="text-slate-400 hover:text-rose-500 p-1 rounded-lg hover:bg-rose-50 transition-all cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                `;
                list.insertBefore(row, emptyView);
            });

            // Adjust totals
            const grandTotal = subtotal - transactionDiscount;
            
            document.getElementById('sum-subtotal').innerText = `Rp ${numberFormat(subtotal)}`;
            document.getElementById('sum-discount').innerText = `- Rp ${numberFormat(transactionDiscount)}`;
            document.getElementById('sum-grandtotal').innerText = `Rp ${numberFormat(grandTotal)}`;
        }

        // Open/Close Discount Modals
        function openDiscountModal() {
            document.getElementById('discount-modal').style.display = 'flex';
            document.getElementById('input-discount-nominal').focus();
        }
        function closeDiscountModal() {
            document.getElementById('discount-modal').style.display = 'none';
        }
        function applyDiscount() {
            const nominal = parseFloat(document.getElementById('input-discount-nominal').value) || 0;
            transactionDiscount = nominal;
            updateCartUI();
            closeDiscountModal();
        }

        // PAYMENT FLOW (F9)
        function openPaymentModal() {
            const modal = document.getElementById('payment-modal');
            const total = calculateGrandTotal();

            document.getElementById('pay-grand-total').innerText = `Rp ${numberFormat(total)}`;
            document.getElementById('input-cash-amount').value = total; // Default to exact amount
            
            // Setup Quick Cash Buttons
            setupQuickCashButtons(total);

            // Trigger change calculation
            calculateChange();
            
            // Generate dynamic QRIS with exact amount
            updateQRISImage(total);
            
            modal.style.display = 'flex';
            
            // Check internet for QRIS
            if (!navigator.onLine) {
                selectPaymentMethod('cash'); // Force cash when offline
                document.getElementById('btn-pay-qris').disabled = true;
                document.getElementById('btn-pay-qris').style.opacity = 0.5;
            } else {
                document.getElementById('btn-pay-qris').disabled = false;
                document.getElementById('btn-pay-qris').style.opacity = 1;
                selectPaymentMethod('cash'); // Default online is cash too
            }
        }

        function closePaymentModal() {
            document.getElementById('payment-modal').style.display = 'none';
        }

        function selectPaymentMethod(method) {
            selectedPaymentMethod = method;
            const btnCash = document.getElementById('btn-pay-cash');
            const btnQris = document.getElementById('btn-pay-qris');
            
            const cashView = document.getElementById('payment-cash-view');
            const qrisView = document.getElementById('payment-qris-view');
            
            const btnSubmit = document.getElementById('btn-submit-trans');
            if (method === 'cash') {
                btnCash.className = "py-4 px-4 bg-indigo-50 border-2 border-indigo-600 text-indigo-700 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all";
                btnQris.className = "py-4 px-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all hover:bg-slate-50";
                
                cashView.classList.remove('hidden');
                qrisView.classList.add('hidden');
                calculateChange();
            } else {
                btnQris.className = "py-4 px-4 bg-indigo-50 border-2 border-indigo-600 text-indigo-700 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all";
                btnCash.className = "py-4 px-4 bg-white border border-slate-200 text-slate-600 rounded-2xl font-bold flex flex-col items-center justify-center space-y-2 cursor-pointer transition-all hover:bg-slate-50";
                
                qrisView.classList.remove('hidden');
                cashView.classList.add('hidden');
                
                // QRIS matches total automatically and is always valid
                btnSubmit.disabled = false;
                btnSubmit.className = "flex-1 py-3.5 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-2xl text-sm transition-all shadow-lg active:scale-95 cursor-pointer text-center flex items-center justify-center space-x-2";
            }
        }

        function setupQuickCashButtons(total) {
            const grid = document.getElementById('quick-cash-grid');
            grid.innerHTML = '';

            // Denominations proposal
            const standardDenoms = [10000, 20000, 50000, 100000];
            const denoms = [total]; // Exact cash first
            
            standardDenoms.forEach(d => {
                if (d > total && !denoms.includes(d)) {
                    denoms.push(d);
                }
            });
            
            // Add top denoms up to 6 buttons
            while (denoms.length < 6) {
                const max = Math.max(...denoms);
                if (max < 100000) denoms.push(100000);
                else denoms.push(max + 50000);
            }
            
            // Sort denoms (excluding total exact first)
            const sortedDenoms = [total, ...denoms.filter(d => d !== total).sort((a,b)=>a-b)].slice(0, 6);

            sortedDenoms.forEach((val, idx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.setAttribute('data-val', val);
                btn.onclick = () => {
                    document.getElementById('input-cash-amount').value = val;
                    calculateChange();
                };
                
                if (val === total) {
                    btn.innerText = "UANG PAS";
                } else {
                    btn.innerText = `Rp ${numberFormat(val)}`;
                }
                grid.appendChild(btn);
            });
            
            highlightSelectedQuickCash(parseFloat(document.getElementById('input-cash-amount').value) || 0);
        }

        function highlightSelectedQuickCash(currentVal) {
            const btns = document.querySelectorAll('#quick-cash-grid button');
            const total = calculateGrandTotal();
            btns.forEach(btn => {
                const btnVal = parseFloat(btn.getAttribute('data-val'));
                if (btnVal === currentVal) {
                    // Highlight selected state
                    if (btnVal === total) {
                        btn.className = "py-2.5 bg-emerald-600 text-white font-extrabold text-xs rounded-xl shadow-md cursor-pointer border-2 border-emerald-400 ring-2 ring-emerald-500/30 scale-[1.02] transition-all";
                    } else {
                        btn.className = "py-2.5 bg-indigo-600 text-white font-extrabold text-xs rounded-xl border-2 border-indigo-400 shadow-md cursor-pointer ring-2 ring-indigo-500/30 scale-[1.02] transition-all";
                    }
                } else {
                    // Unselected state
                    if (btnVal === total) {
                        btn.className = "py-2.5 bg-emerald-50 text-emerald-600 font-extrabold text-xs rounded-xl border border-emerald-200 cursor-pointer hover:bg-emerald-100 transition-all";
                    } else {
                        btn.className = "py-2.5 bg-slate-50 hover:bg-slate-100 text-slate-600 font-bold text-xs rounded-xl border border-slate-200 cursor-pointer transition-all";
                    }
                }
            });
        }

        function calculateChange() {
            if (selectedPaymentMethod !== 'cash') return;

            const total = calculateGrandTotal();
            const cash = parseFloat(document.getElementById('input-cash-amount').value) || 0;
            const change = cash - total;
            
            if (typeof highlightSelectedQuickCash === 'function') {
                highlightSelectedQuickCash(cash);
            }
            
            const btnSubmit = document.getElementById('btn-submit-trans');
            const changeDisplay = document.getElementById('cash-change-due');

            if (change >= 0) {
                changeDisplay.innerText = `Rp ${numberFormat(change)}`;
                changeDisplay.className = "font-extrabold text-lg text-emerald-600";
                
                btnSubmit.disabled = false;
                btnSubmit.className = "flex-1 py-3.5 px-4 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold rounded-2xl text-sm transition-all shadow-lg active:scale-95 cursor-pointer text-center flex items-center justify-center space-x-2";
            } else {
                changeDisplay.innerText = "Kurang Bayar";
                changeDisplay.className = "font-extrabold text-sm text-rose-500";
                
                btnSubmit.disabled = true;
                btnSubmit.className = "flex-1 py-3.5 px-4 bg-slate-300 text-slate-500 font-bold rounded-2xl text-sm transition-all shadow-md text-center flex items-center justify-center space-x-2";
            }
        }

        // Helper calculations
        function calculateGrandTotal() {
            let subtotal = 0;
            cart.forEach(item => {
                subtotal += (item.sell_price - item.discount) * item.qty;
            });
            return Math.max(0, subtotal - transactionDiscount);
        }

        // Submitting Transaction (Direct Online POST or Offline Storage)
        function submitTransaction() {
            const total = calculateGrandTotal();
            let subtotal = 0;
            cart.forEach(item => {
                subtotal += (item.sell_price - item.discount) * item.qty;
            });

            const amountPaid = selectedPaymentMethod === 'cash' ? 
                parseFloat(document.getElementById('input-cash-amount').value) || 0 : 
                total;
            const changeDue = selectedPaymentMethod === 'cash' ? (amountPaid - total) : 0;

            const payload = {
                cart: cart,
                subtotal: subtotal,
                discount: transactionDiscount,
                grand_total: total,
                payment_method: selectedPaymentMethod,
                amount_paid: amountPaid,
                change_due: changeDue
            };

            // Check if Offline
            if (!navigator.onLine) {
                saveTransactionOffline(payload);
                return;
            }

            // If Online, POST to server
            fetch('{{ route("pos.transaction.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closePaymentModal();
                    
                    // Show Mock Printer & Print receipt
                    showReceiptInPrinterConsole(data.receipt);
                    
                    // Adjust products local stocks in current UI view
                    cart.forEach(item => {
                        const localProd = productsData.find(p => p.id === item.id);
                        if (localProd) localProd.stock -= item.qty;
                    });
                    
                    // Reset cart
                    cart = [];
                    transactionDiscount = 0;
                    updateCartUI();
                    renderProducts();
                    
                    // Show Success Modal
                    openSuccessModal(data.receipt, payload.amount_paid);
                    
                    if (document.getElementById('auto-print-checkbox').checked) {
                        setTimeout(() => printViaThermerModal(), 500);
                    }
                    
                } else {
                    alert('Gagal memproses transaksi: ' + data.message);
                }
            })
            .catch(err => {
                alert('Kesalahan koneksi ke server, transaksi dialihkan ke penyimpanan offline lokal.');
                saveTransactionOffline(payload);
            });
        }

        // OFFLINE CAPABILITY: Saving transaction locally
        function saveTransactionOffline(payload) {
            // Check offline payment restriction: Cash only
            if (payload.payment_method !== 'cash') {
                alert('Mode Offline: Pembayaran QRIS tidak didukung secara offline. Mohon pilih metode TUNAI.');
                return;
            }

            // Generate an offline local Invoice ID
            const todayStr = new Date().toISOString().slice(0,10).replace(/-/g,"");
            const randomId = Math.floor(1000 + Math.random() * 9000);
            const invoiceNumber = `TR-OFFLINE-${todayStr}-${randomId}`;

            payload.invoice_number = invoiceNumber;
            payload.local_id = 'off_' + Date.now();
            payload.created_at = new Date().toISOString();

            // Load existing offline queue
            let offlineQueue = JSON.parse(localStorage.getItem('offline_transactions_queue')) || [];
            offlineQueue.push(payload);
            localStorage.setItem('offline_transactions_queue', JSON.stringify(offlineQueue));

            // Subtract stock locally
            cart.forEach(item => {
                const localProd = productsData.find(p => p.id === item.id);
                if (localProd) localProd.stock -= item.qty;
            });

            // Format simulated receipt text locally
            const localReceipt = generateLocalOfflineReceiptText(payload);

            closePaymentModal();
            showReceiptInPrinterConsole(localReceipt);

            // Reset cart
            cart = [];
            transactionDiscount = 0;
            updateCartUI();
            renderProducts();
            
            // Show Success Modal
            openSuccessModal(localReceipt, payload.amount_paid);
            
            if (document.getElementById('auto-print-checkbox').checked) {
                setTimeout(() => printViaThermerModal(), 500);
            }
        }

        // Generate Local offline receipt template formatting
        function generateLocalOfflineReceiptText(payload) {
            const chars = parseInt(shopSettings.printer_chars_per_line) || 32;
            const separator = '-'.repeat(chars);
            let out = [];
            out.push(centerText(shopSettings.name, chars));
            out.push(centerText(shopSettings.subtitle, chars));
            out.push(centerText(shopSettings.address, chars));
            out.push(centerText("Telp: " + shopSettings.phone, chars));
            out.push(separator);
            const tgl = new Date().toLocaleString('id-ID', {day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute:'2-digit'}).replace(/\./g, ':');
            const kasir = "{{ Auth::user()->name }}".substring(0, 10);
            const spacesTgl = chars - tgl.length - ("Ksr: " + kasir).length;
            out.push(tgl + ' '.repeat(spacesTgl > 0 ? spacesTgl : 1) + "Ksr: " + kasir);
            out.push("Struk: " + payload.invoice_number);
            out.push("Status: *OFFLINE SAVE*");
            out.push(separator);

            payload.cart.forEach(item => {
                const fullName = `[${item.product_code}] ${item.name}`;
                let remaining = fullName;
                while (remaining.length > 0) {
                    let chunk = remaining.substring(0, chars);
                    let spaceIdx = chunk.lastIndexOf(' ');
                    if (remaining.length > chars && spaceIdx > 0) {
                        chunk = remaining.substring(0, spaceIdx);
                        remaining = remaining.substring(spaceIdx + 1);
                    } else {
                        remaining = remaining.substring(chars);
                    }
                    out.push(chunk.padEnd(chars, ' '));
                }
                
                const qtyText = `  ${item.qty} ${item.unit} x ${numberFormat(item.sell_price)}`;
                const subTotalText = numberFormat((item.sell_price - item.discount) * item.qty);
                const spaces = chars - qtyText.length - subTotalText.length;
                out.push(qtyText + ' '.repeat(spaces > 0 ? spaces : 1) + subTotalText);
            });

            out.push(separator);
            out.push(rightAlignedLabelValue("SUBTOTAL:", numberFormat(payload.subtotal), chars));
            if (payload.discount > 0) {
                out.push(rightAlignedLabelValue("DISKON:", "-" + numberFormat(payload.discount), chars));
            }
            out.push(rightAlignedLabelValue("TOTAL:", numberFormat(payload.grand_total), chars));
            out.push(rightAlignedLabelValue("BAYAR (TUNAI):", numberFormat(payload.amount_paid), chars));
            out.push(rightAlignedLabelValue("KEMBALI:", numberFormat(payload.change_due), chars));
            out.push(separator);
            const footerText = shopSettings.receipt_footer || "TERIMA KASIH ATAS KUNJUNGAN\nANDA!";
            const footerLines = footerText.split('\n');
            footerLines.forEach(line => {
                let remaining = line.trim();
                if (remaining.length === 0) {
                    out.push('');
                    return;
                }
                while (remaining.length > 0) {
                    let chunk = remaining.substring(0, chars);
                    let spaceIdx = chunk.lastIndexOf(' ');
                    if (remaining.length > chars && spaceIdx > 0) {
                        chunk = remaining.substring(0, spaceIdx);
                        remaining = remaining.substring(spaceIdx + 1);
                    } else {
                        remaining = remaining.substring(chars);
                    }
                    out.push(centerText(chunk, chars));
                }
            });

            return out.join("\n");
        }

        // Automatic Offline Sync when Online
        function syncOfflineQueue() {
            checkOfflineStatus();
            
            let queue = JSON.parse(localStorage.getItem('offline_transactions_queue')) || [];
            if (queue.length === 0) return;

            console.log('Online detected: Synchronizing ' + queue.length + ' transactions...');
            
            fetch('{{ route("pos.transaction.sync") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ transactions: queue })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Remove successfully synced IDs from local storage queue
                    const syncedIds = data.synced_local_ids;
                    let currentQueue = JSON.parse(localStorage.getItem('offline_transactions_queue')) || [];
                    let remainingQueue = currentQueue.filter(item => !syncedIds.includes(item.local_id));
                    
                    localStorage.setItem('offline_transactions_queue', JSON.stringify(remainingQueue));
                    console.log('Offline queue synced successfully!');
                }
            })
            .catch(err => {
                console.error('Failed to sync offline queue: ', err);
            });
        }

        // Check Connection status & update UI alerts
        function checkOfflineStatus() {
            const banner = document.getElementById('offline-banner');
            const dot = document.getElementById('status-dot');
            const text = document.getElementById('status-text');

            if (!navigator.onLine) {
                banner.classList.remove('hidden');
                dot.className = "w-3 h-3 bg-amber-500 rounded-full animate-pulse";
                text.innerText = "Offline Mode";
                text.className = "text-xs font-bold text-amber-500 uppercase tracking-wider";
            } else {
                banner.classList.add('hidden');
                dot.className = "w-3 h-3 bg-emerald-500 rounded-full animate-ping";
                text.innerText = "Online";
                text.className = "text-xs font-bold text-slate-400 uppercase tracking-wider";
            }
        }

        // MOCK PRINTER SIMULATOR RENDER & ANIMATION
        function showReceiptInPrinterConsole(receiptText) {
            const panel = document.getElementById('printer-panel');
            const paper = document.getElementById('receipt-paper');
            
            // Inject text
            paper.innerText = receiptText;
            
            // Slide in panel
            panel.classList.remove('translate-x-full');
            
            // Animate printing paper feed
            paper.classList.remove('opacity-0', 'translate-y-4');
            paper.classList.add('opacity-100', 'translate-y-0');
        }

        function togglePrinterPanel() {
            const panel = document.getElementById('printer-panel');
            panel.classList.toggle('translate-x-full');
        }

        function printViaThermer() {
            const paper = document.getElementById('receipt-paper');
            if (!paper || !paper.innerText || paper.innerText.trim() === '') {
                alert("Struk kosong!");
                return;
            }
            const encodedText = encodeURIComponent(paper.innerText);
            const baseUrl = window.location.origin;
            const responseUrl = `${baseUrl}/api/print-receipt?content=${encodedText}`;
            window.location.href = `my.bluetoothprint.scheme://${responseUrl}`;
        }

        function animateReceiptPrinting() {
            const paper = document.getElementById('receipt-paper');
            paper.classList.remove('opacity-100', 'translate-y-0');
            paper.classList.add('opacity-0', 'translate-y-4');
            
            setTimeout(() => {
                paper.classList.remove('opacity-0', 'translate-y-4');
                paper.classList.add('opacity-100', 'translate-y-0');
            }, 300);
        }

        // Local hold/pending transaction support (Hold Cart)
        function handleHoldTransaction() {
            if (cart.length === 0) {
                // If cart is empty, try to resume a suspended cart
                const heldCart = localStorage.getItem('held_transaction');
                if (heldCart) {
                    cart = JSON.parse(heldCart);
                    transactionDiscount = parseFloat(localStorage.getItem('held_transaction_discount')) || 0;
                    localStorage.removeItem('held_transaction');
                    localStorage.removeItem('held_transaction_discount');
                    updateCartUI();
                    alert('Berhasil memuat kembali keranjang belanja yang di-Hold!');
                } else {
                    alert('Keranjang belanja kosong. Tidak ada transaksi untuk di-Hold.');
                }
                return;
            }

            // Suspend cart
            localStorage.setItem('held_transaction', JSON.stringify(cart));
            localStorage.setItem('held_transaction_discount', transactionDiscount.toString());
            cart = [];
            transactionDiscount = 0;
            updateCartUI();
            alert('Transaksi berhasil di-Hold! Keranjang dibersihkan untuk pelanggan berikutnya.');
        }

        // Close Shift Trigger
        function openCloseShiftModal() {
            document.getElementById('close-shift-modal').style.display = 'flex';
        }
        function closeCloseShiftModal() {
            document.getElementById('close-shift-modal').style.display = 'none';
        }

        // Utilities formatting
        function numberFormat(val) {
            return new Intl.NumberFormat('id-ID').format(val);
        }

        function centerText(text, width) {
            text = text.trim();
            if (text.length >= width) return text.substring(0, width);
            const padding = (width - text.length) / 2;
            return ' '.repeat(Math.floor(padding)) + text + ' '.repeat(Math.ceil(padding));
        }

        function rightAlignedLabelValue(label, value, width = 32) {
            const spaces = width - label.length - value.toString().length;
            return label + ' '.repeat(spaces > 0 ? spaces : 1) + value;
        }

        // QRIS Dynamic Generator Utilities
        const STATIC_QRIS_PAYLOAD = "00020101021126590013ID.CO.BNI.WWW011893600009150464484302096095449940303UMI51440014ID.CO.QRIS.WWW0215ID10265223592840303UMI5204541153033605802ID5925TOKO SEMBAKO PLASTIK BAUN6010BANJARBARU61057071462070703A01630488E2";

        function crc16(str) {
            let crc = 0xFFFF;
            for (let c = 0; c < str.length; c++) {
                let code = str.charCodeAt(c);
                crc ^= (code << 8);
                for (let i = 0; i < 8; i++) {
                    if (crc & 0x8000) {
                        crc = ((crc << 1) ^ 0x1021) & 0xFFFF;
                    } else {
                        crc = (crc << 1) & 0xFFFF;
                    }
                }
            }
            return crc.toString(16).toUpperCase().padStart(4, '0');
        }

        function generateDynamicQRIS(staticQRIS, amount) {
            let qrisWithoutCrc = staticQRIS.slice(0, -4);
            qrisWithoutCrc = qrisWithoutCrc.replace('010211', '010212');
            
            const currencyTag = '5303360';
            const amountStr = Math.round(amount).toString();
            const amountTag = '54' + amountStr.length.toString().padStart(2, '0') + amountStr;
            
            if (qrisWithoutCrc.includes(currencyTag)) {
                qrisWithoutCrc = qrisWithoutCrc.replace(currencyTag, currencyTag + amountTag);
            } else {
                qrisWithoutCrc += amountTag;
            }
            
            return qrisWithoutCrc + crc16(qrisWithoutCrc);
        }

        function updateQRISImage(amount) {
            try {
                const dynamicPayload = generateDynamicQRIS(STATIC_QRIS_PAYLOAD, amount);
                const qrCodeUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(dynamicPayload)}&size=200x200`;
                document.getElementById('qris-image-placeholder').src = qrCodeUrl;
            } catch (err) {
                console.error("Error generating dynamic QRIS:", err);
            }
        }

        // Background sync function for cashier data (products, categories, shift status)
        function syncPOSData() {
            if (!navigator.onLine) return;

            fetch('{{ route('pos.products.sync_data') }}')
                .then(response => response.json())
                .then(data => {
                    hasActiveShift = data.active_shift;

                    if (data.products && Array.isArray(data.products)) {
                        const changed = JSON.stringify(data.products) !== JSON.stringify(productsData);
                        if (changed) {
                            productsData.length = 0;
                            data.products.forEach(p => productsData.push(p));
                            renderProducts();

                            let cartChanged = false;
                            cart.forEach(item => {
                                const latestProd = productsData.find(p => p.id === item.id);
                                if (latestProd) {
                                    const newPrice = parseFloat(latestProd.sell_price);
                                    if (item.sell_price !== newPrice) {
                                        item.sell_price = newPrice;
                                        cartChanged = true;
                                    }
                                    if (item.name !== latestProd.name) {
                                        item.name = latestProd.name;
                                        cartChanged = true;
                                    }
                                }
                            });
                            if (cartChanged) {
                                updateCartUI();
                            }
                        }
                    }

                    if (data.categories && Array.isArray(data.categories)) {
                        const changed = JSON.stringify(data.categories) !== JSON.stringify(categoriesData);
                        if (changed) {
                            categoriesData.length = 0;
                            data.categories.forEach(c => categoriesData.push(c));
                            renderCategoryTabs();
                        }
                    }
                })
                .catch(error => {
                    console.error('Error in background data sync:', error);
                });
        }

        function renderCategoryTabs() {
            const container = document.getElementById('category-tabs-container');
            if (!container) return;
            
            let html = `
                <button onclick="filterCategory('all')" id="cat-tab-all"
                        class="${currentCategoryFilter === 'all' ? 'px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-indigo-600/10 shrink-0 cursor-pointer uppercase' : 'px-4 py-2 bg-slate-100 text-slate-650 border border-slate-200 hover:bg-slate-200 rounded-xl text-xs font-bold transition-all shrink-0 cursor-pointer uppercase'}">
                    Semua
                </button>
            `;
            
            categoriesData.forEach(cat => {
                const isActive = currentCategoryFilter == cat.id;
                html += `
                    <button onclick="filterCategory('${cat.id}')" id="cat-tab-${cat.id}"
                            class="${isActive ? 'px-4 py-2 bg-indigo-600 text-white rounded-xl text-xs font-bold transition-all shadow-md shadow-indigo-600/10 shrink-0 cursor-pointer uppercase' : 'px-4 py-2 bg-slate-100 text-slate-650 border border-slate-200 hover:bg-slate-200 rounded-xl text-xs font-bold transition-all shrink-0 cursor-pointer uppercase'}">
                        ${cat.name}
                    </button>
                `;
            });
            
            container.innerHTML = html;
        }
    </script>
    <!-- PWA Service Worker Registration -->
    <script>
        function openSuccessModal(receiptText, amountPaid) {
            document.getElementById('success-receipt-preview').innerText = receiptText;
            if (amountPaid !== undefined && amountPaid !== null) {
                document.getElementById('success-modal-amount-paid').innerText = "Total Bayar: Rp " + numberFormat(amountPaid);
                document.getElementById('success-modal-amount-paid').style.display = 'inline-block';
            } else {
                document.getElementById('success-modal-amount-paid').style.display = 'none';
            }
            document.getElementById('success-modal').style.display = 'flex';
        }
        function closeSuccessModal() {
            document.getElementById('success-modal').style.display = 'none';
        }

        function printViaThermerModal() {
            const text = document.getElementById('success-receipt-preview').innerText;
            const encodedText = encodeURIComponent(text);
            const baseUrl = window.location.origin;
            const responseUrl = `${baseUrl}/api/print-receipt?content=${encodedText}`;
            window.location.href = `my.bluetoothprint.scheme://${responseUrl}`;
        }

        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(reg => console.log('Service Worker registered.'))
                    .catch(err => console.log('Service Worker registration failed: ', err));
            });
        }
    </script>
</body>
</html>
