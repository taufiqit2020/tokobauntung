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
    </style>
</head>
<body class="bg-slate-50 text-slate-800 flex h-screen overflow-hidden">

    <!-- Mobile Sidebar / Drawer (Hidden by default) -->
    <div id="mobile-sidebar" class="fixed inset-0 z-50 flex hidden">
        <!-- Backdrop -->
        <div onclick="toggleMobileSidebar()" class="fixed inset-0 bg-slate-950/60 backdrop-blur-sm"></div>
        
        <!-- Drawer Content -->
        <aside class="relative w-64 bg-slate-900 text-slate-100 flex flex-col justify-between h-full shadow-2xl z-10">
            <div>
                <!-- Header -->
                <div class="p-6 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="p-2 bg-indigo-500 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="font-bold text-md tracking-tight text-white uppercase">Menu Navigasi</h1>
                        </div>
                    </div>
                    <button onclick="toggleMobileSidebar()" class="text-slate-400 hover:text-white p-1 hover:bg-slate-800 rounded-lg cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="p-4 space-y-1">
                    @if(Auth::user()->role === 'keuangan')
                        <a href="{{ route('keuangan.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.dashboard') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('keuangan.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.products') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Produk & Stok</span>
                        </a>
                        <a href="{{ route('keuangan.stock_opname') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.stock_opname') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Stock Opname</span>
                        </a>
                        <a href="{{ route('keuangan.expenses') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.expenses') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Pengeluaran Toko</span>
                        </a>
                        <a href="{{ route('keuangan.es_teguk') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.es_teguk') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Pemasukan Es Teguk</span>
                        </a>
                        <a href="{{ route('keuangan.reports') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.reports') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Laporan Penjualan</span>
                        </a>
                    @elseif(Auth::user()->role === 'admin_it')
                        <a href="{{ route('it.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.dashboard') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Dashboard IT</span>
                        </a>
                        <a href="{{ route('it.users') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.users') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Manajemen User</span>
                        </a>
                        <a href="{{ route('it.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.settings') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                            <span>Pengaturan Toko</span>
                        </a>
                    @endif
                </nav>
            </div>

            <!-- Footer / User Details -->
            <div class="p-4 border-t border-slate-800 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white uppercase text-sm">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </aside>
    </div>

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-slate-100 flex flex-col justify-between shrink-0 shadow-xl hidden md:flex">
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
                <div class="p-2 bg-indigo-500 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </div>
                <div>
                    <h1 class="font-bold text-lg tracking-tight text-white">BAUNTUNGPOS</h1>
                    <span class="text-slate-500 text-xs font-semibold uppercase tracking-wider">Toko Sembako & Plastik</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1">
                @if(Auth::user()->role === 'keuangan')
                    <a href="{{ route('keuangan.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.dashboard') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    
                    <a href="{{ route('keuangan.products') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.products') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span>Produk & Stok</span>
                    </a>

                    <a href="{{ route('keuangan.stock_opname') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.stock_opname') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Stock Opname</span>
                    </a>

                    <a href="{{ route('keuangan.expenses') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.expenses') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15M5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                        </svg>
                        <span>Pengeluaran Toko</span>
                    </a>

                    <a href="{{ route('keuangan.es_teguk') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.es_teguk') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.958-.659-1.171-.879-1.171-2.305 0-3.182 1.172-.879 3.07-.879 4.242 0 .88.66 1.459 1.579 1.737 2.618M12 3v3m0 12v3" />
                        </svg>
                        <span>Pemasukan Es Teguk</span>
                    </a>

                    <a href="{{ route('keuangan.reports') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('keuangan.reports') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                        </svg>
                        <span>Laporan Penjualan</span>
                    </a>
                @elseif(Auth::user()->role === 'admin_it')
                    <a href="{{ route('it.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.dashboard') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25" />
                        </svg>
                        <span>Dashboard IT</span>
                    </a>

                    <a href="{{ route('it.users') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.users') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0112 19.5c-3.166 0-6.079-.851-8.585-2.334m12.185-4.591a3 3 0 11-6 0 3 3 0 016 0zM1.866 18.025a3.006 3.006 0 003.58 1.248M12 15.75a7.488 7.488 0 00-5.136-3.014m5.136 3.014A7.496 7.496 0 0117.25 15.75m0 0a7.49 7.49 0 01-5.136 3.014" />
                        </svg>
                        <span>Manajemen User</span>
                    </a>

                    <a href="{{ route('it.settings') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all text-sm {{ Route::is('it.settings') ? 'bg-indigo-600 text-white font-semibold shadow-md shadow-indigo-600/20' : 'text-slate-400 hover:bg-slate-800 hover:text-slate-100' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.43l-1.003.828c-.293.241-.438.613-.43.992a7.723 7.723 0 010 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.43l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.991l-1.004-.827a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.645-.869l.214-1.28z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan Toko</span>
                    </a>
                @endif
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-800 flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center font-bold text-white uppercase text-sm">
                    {{ substr(Auth::user()->name, 0, 2) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-semibold text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 capitalize">{{ Auth::user()->role }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-slate-500 hover:text-rose-400 p-1.5 rounded-lg hover:bg-slate-800 transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M19 12H9m10 0-4-4m4 4-4 4" />
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Top Navbar -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-6 shrink-0 z-10 shadow-sm">
            <div class="flex items-center space-x-4">
                <button onclick="toggleMobileSidebar()" class="md:hidden text-slate-600 hover:text-slate-900 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
                <h2 class="text-lg font-bold text-slate-900 uppercase">@yield('page_title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Date Indicator -->
                <span class="text-slate-500 text-sm hidden sm:inline-block font-medium">
                    {{ \Carbon\Carbon::now()->isoFormat('dddd, D MMMM YYYY') }}
                </span>
                
                <div class="h-6 w-[1px] bg-slate-200 hidden sm:inline-block"></div>
                
                <!-- Role Badge -->
                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full border border-indigo-100 uppercase tracking-wider">
                    {{ str_replace('_', ' ', Auth::user()->role) }}
                </span>

                <!-- Top Logout Button (Easy for mobile & tablet) -->
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-1.5 text-slate-500 hover:text-rose-600 rounded-lg hover:bg-slate-100 transition-all cursor-pointer flex items-center" title="Keluar">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M19 12H9m10 0-4-4m4 4-4 4" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Container -->
        <div class="flex-1 overflow-y-auto p-6">
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 text-sm mb-6 flex items-center space-x-3 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-emerald-600 shrink-0">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.748-5.25Z" clip-rule="evenodd" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-200 text-rose-800 rounded-xl p-4 text-sm mb-6 shadow-sm">
                    <div class="flex items-center space-x-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 text-rose-600 shrink-0">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                        </svg>
                        <span class="font-bold">Terjadi Kesalahan:</span>
                    </div>
                    <ul class="list-disc pl-8 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
    <script>
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobile-sidebar');
            if (sidebar.classList.contains('hidden')) {
                sidebar.classList.remove('hidden');
            } else {
                sidebar.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
