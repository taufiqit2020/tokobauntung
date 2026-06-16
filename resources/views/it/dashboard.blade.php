@extends('layouts.app')

@section('title', 'Dashboard IT Admin')
@section('page_title', 'Status Sistem & Dashboard IT')

@section('content')
<div class="space-y-6">

    <!-- System Stats Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Total Pengguna</span>
                <p class="text-2xl font-bold text-slate-800">{{ $totalUsers }} User</p>
                <span class="text-[10px] text-slate-400">Semua role terdaftar</span>
            </div>
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.97 5.97 0 0 0-.75-2.906m-.75 2.906a3.01 3.01 0 0 1-6.008 0m-6.008 0a3 3 0 0 1 3-3h.008a3 3 0 0 1 3 3m0 0V18c0-1.335-.054-2.6-.16-3.807m0 0a5.97 5.97 0 0 1-.75 2.906m.75-2.906a3.01 3.01 0 0 0-6.008 0M3 18.72a3.001 3.001 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m0 0a5.97 5.97 0 0 0-.75-2.906m-.75 2.906a3.01 3.01 0 0 1-6.008 0M3.75 3.75h.008v.008H3.75V3.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 7.5h.008v.008H3.75V7.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 11.25h.008v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
        </div>

        <!-- Active Users -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Pengguna Aktif</span>
                <p class="text-2xl font-bold text-emerald-600">{{ $activeUsers }} Aktif</p>
                <span class="text-[10px] text-slate-400">Akun berstatus aktif</span>
            </div>
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12z" />
                </svg>
            </div>
        </div>

        <!-- Total Sales count -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Total Transaksi</span>
                <p class="text-2xl font-bold text-slate-800">{{ $totalTransactions }} Transaksi</p>
                <span class="text-[10px] text-slate-400">Total riwayat penjualan</span>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                </svg>
            </div>
        </div>

        <!-- Database Size -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Ukuran Database</span>
                <p class="text-2xl font-bold text-slate-800">{{ $dbSizeStr }}</p>
                <span class="text-[10px] text-slate-400">Ukuran berkas SQLite</span>
            </div>
            <div class="p-3 bg-rose-50 text-rose-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Details Panels -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left Panel: Recent User creation (2/3 width) -->
        <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Pengguna Terdaftar Baru</h3>
                <a href="{{ route('it.users') }}" class="text-xs text-indigo-600 hover:text-indigo-700 font-bold hover:underline">Kelola &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                            <th class="p-4">Nama</th>
                            <th class="p-4">Username</th>
                            <th class="p-4">Role</th>
                            <th class="p-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach($recentUsers as $user)
                            <tr>
                                <td class="p-4 font-bold text-slate-900">{{ $user->name }}</td>
                                <td class="p-4 font-semibold text-indigo-600">{{ $user->username }}</td>
                                <td class="p-4 uppercase tracking-wide text-slate-500 font-semibold">{{ str_replace('_', ' ', $user->role) }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2 py-0.5 rounded text-[9px] font-bold uppercase {{ $user->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right Column (1/3 width) -->
        <div class="space-y-6">
            <!-- Quick Actions Panel -->
            <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm space-y-4 h-fit">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide pb-2 border-b border-slate-100">Pintasan Cepat</h3>
                
                <a href="{{ route('it.users') }}" class="block p-3 bg-slate-50 border border-slate-200/50 hover:border-indigo-500 rounded-xl transition-all flex items-center space-x-3">
                    <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0zM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-xs">Tambah Kasir / User</h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">Daftarkan akun kasir baru</p>
                    </div>
                </a>

                <a href="{{ route('it.settings') }}" class="block p-3 bg-slate-50 border border-slate-200/50 hover:border-indigo-500 rounded-xl transition-all flex items-center space-x-3">
                    <div class="p-2 bg-purple-50 text-purple-600 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H5.071c-.71 0-1.408.03-2.09.09m0 0c-.09.008-.18.016-.27.026M2.89 15.866a22.887 22.887 0 0 0-1.077 1.077 1.125 1.125 0 0 0 1.59 1.59l.863-.863m-1.376-1.804A22.89 22.89 0 0 1 3.5 13m0 0V8.25m0 0A2.25 2.25 0 0 1 5.75 6H8.25m-2.5 2.25h12.5m-12.5 0v5.25m12.5-5.25v5.25m-12.5 0h12.5m-12.5 0V13m12.5 0A2.25 2.25 0 0 0 16.25 8.25m0 0V8.25" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-xs">Konfigurasi Toko</h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">Ubah alamat, telepon, & struk</p>
                    </div>
                </a>

                <!-- Real Backup Database link -->
                <a href="{{ route('it.backup') }}"
                   class="block p-3 bg-slate-50 border border-slate-200/50 hover:border-indigo-500 rounded-xl transition-all flex items-center space-x-3 cursor-pointer">
                    <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800 text-xs">Backup Database</h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">Unduh cadangan database SQL</p>
                    </div>
                </a>
            </div>

            <!-- Restore Database Panel -->
            <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm space-y-4 h-fit">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide pb-2 border-b border-slate-100 flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5.5 h-5.5 text-indigo-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    <span>Restore Database</span>
                </h3>
                
                <form action="{{ route('it.restore') }}" method="POST" enctype="multipart/form-data" class="space-y-3 text-xs" onsubmit="return confirm('PERINGATAN Kritis: Proses memulihkan database akan menimpa seluruh data transaksi, stok barang, pengeluaran, dan akun saat ini. Apakah Anda yakin ingin memulihkan database toko dari berkas SQL yang Anda pilih?')">
                    @csrf
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-500 uppercase">Pilih Berkas Cadangan (.sql)</label>
                        <input type="file" name="backup_file" accept=".sql" required
                               class="w-full text-[11px] p-2 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <button type="submit"
                            class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer text-center">
                        Unggah & Pulihkan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
