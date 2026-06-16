@extends('layouts.app')

@section('title', 'Dashboard Keuangan')
@section('page_title', 'Ringkasan Laba Rugi & Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Financial Quick Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Today's Revenue -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Omset Hari Ini</span>
                <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($revenueToday, 0, ',', '.') }}</p>
                <span class="text-[10px] text-slate-400">Total penjualan kotor</span>
            </div>
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15M5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                </svg>
            </div>
        </div>

        <!-- Today's Net Profit -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Laba Bersih Hari Ini</span>
                <p class="text-2xl font-bold {{ $netProfitToday >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    Rp {{ number_format($netProfitToday, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-slate-400">Omset - (HPP + Biaya)</span>
            </div>
            <div class="p-3 {{ $netProfitToday >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.958-.659-1.171-.879-1.171-2.305 0-3.182 1.172-.879 3.07-.879 4.242 0 .88.66 1.459 1.579 1.737 2.618M12 3v3m0 12v3" />
                </svg>
            </div>
        </div>

        <!-- Month's Revenue -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Omset Bulan Ini</span>
                <p class="text-2xl font-bold text-slate-800">Rp {{ number_format($revenueMonth, 0, ',', '.') }}</p>
                <span class="text-[10px] text-slate-400">Kumulatif bulan berjalan</span>
            </div>
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                </svg>
            </div>
        </div>

        <!-- Month's Net Profit -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm flex items-center justify-between">
            <div class="space-y-2">
                <span class="text-slate-400 text-xs font-semibold uppercase tracking-wider block">Laba Bersih Bulan Ini</span>
                <p class="text-2xl font-bold {{ $netProfitMonth >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                    Rp {{ number_format($netProfitMonth, 0, ',', '.') }}
                </p>
                <span class="text-[10px] text-slate-400">Estimasi laba bersih bersih</span>
            </div>
            <div class="p-3 {{ $netProfitMonth >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12a9.75 9.75 0 1 1 19.5 0 9.75 9.75 0 0 1-19.5 0Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left 2 Columns: Shifts and Sales Performances -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Active Cashier Shift Tracker -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Shift Kasir Aktif Saat Ini</h3>
                    <span class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-ping"></span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                                <th class="p-4">Nama Kasir</th>
                                <th class="p-4">Mulai Shift</th>
                                <th class="p-4 text-right">Modal Awal</th>
                                <th class="p-4 text-right">Transaksi Terhitung</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @forelse($activeShifts as $ashift)
                                @php
                                    $transTotal = \App\Models\Transaction::where('shift_id', $ashift->id)->sum('grand_total');
                                @endphp
                                <tr>
                                    <td class="p-4 font-bold text-slate-800 flex items-center space-x-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                        <span>{{ $ashift->user->name }}</span>
                                    </td>
                                    <td class="p-4">{{ \Carbon\Carbon::parse($ashift->start_time)->format('H:i:s (d M)') }}</td>
                                    <td class="p-4 text-right font-semibold">Rp {{ number_format($ashift->starting_cash, 0, ',', '.') }}</td>
                                    <td class="p-4 text-right font-bold text-indigo-600">Rp {{ number_format($transTotal, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-slate-400 font-medium">Tidak ada kasir yang sedang aktif bertugas saat ini.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Top Products -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4">Produk Paling Terlaris</h3>
                <div class="space-y-4">
                    @forelse($topProducts as $idx => $item)
                        <div class="flex items-center justify-between p-3 bg-slate-50 border border-slate-200/50 rounded-xl">
                            <div class="flex items-center space-x-3">
                                <span class="w-6 h-6 rounded-lg bg-indigo-50 text-indigo-600 font-bold text-xs flex items-center justify-center">
                                    {{ $idx + 1 }}
                                </span>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-xs">
                                        {{ $item->product->name }}
                                    </h4>
                                    <span class="text-[10px] text-slate-400 font-semibold uppercase">{{ $item->product->product_code }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="font-extrabold text-xs text-indigo-600">{{ $item->total_sold }} {{ $item->product->unit }}</span>
                                <span class="text-[9px] text-slate-400 block mt-0.5">Sudah terjual</span>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-slate-400 text-xs py-4">Belum ada transaksi terekam.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right 1 Column: Low Stock Alerts & Recent Shifts -->
        <div class="space-y-6">
            <!-- Low Stock Warnings -->
            <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Peringatan Stok Minimum</h3>
                    @if($lowStockCount > 0)
                        <span class="px-2 py-0.5 bg-rose-100 text-rose-700 text-[9px] font-bold rounded border border-rose-200 animate-pulse">
                            {{ $lowStockCount }} ITEM
                        </span>
                    @endif
                </div>

                <div class="space-y-3">
                    @forelse($lowStockProducts as $lp)
                        <div class="p-3 bg-rose-50/50 border border-rose-100 rounded-xl flex justify-between items-center">
                            <div>
                                <h4 class="font-bold text-slate-800 text-xs">{{ $lp->name }}</h4>
                                <span class="text-[9px] text-slate-400 uppercase font-semibold">Kode: {{ $lp->product_code }}</span>
                            </div>
                            <div class="text-right">
                                <span class="font-bold text-xs text-rose-600 block">{{ $lp->stock }} / {{ $lp->min_stock }} {{ $lp->unit }}</span>
                                <span class="text-[9px] text-slate-400">Sisa Stok</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-8 text-center text-emerald-600 flex flex-col items-center justify-center space-y-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 text-emerald-500">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.748-5.25Z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-xs font-semibold">Semua stok barang dalam kondisi aman.</span>
                        </div>
                    @endforelse

                    @if($lowStockCount > 5)
                        <a href="{{ route('keuangan.products', ['filter' => 'low_stock']) }}" class="block text-center text-xs text-indigo-600 hover:text-indigo-700 font-bold hover:underline pt-2">
                            Lihat Semua Stok Tipis ({{ $lowStockCount }}) &rarr;
                        </a>
                    @endif
                </div>
            </div>

            <!-- Recent Shift Log History -->
            <div class="bg-white border border-slate-200 p-5 rounded-2xl shadow-sm">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4">Riwayat Shift Kasir Terakhir</h3>
                <div class="space-y-4">
                    @foreach($recentShiftLogs as $log)
                        <div class="text-xs border-b border-slate-100 pb-3 last:border-b-0 last:pb-0">
                            <div class="flex justify-between items-center font-bold">
                                <span class="text-slate-800">{{ $log->user->name }}</span>
                                <span class="px-2 py-0.5 rounded text-[9px] uppercase font-bold {{ $log->status === 'open' ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-600 border border-slate-200' }}">
                                    {{ $log->status }}
                                </span>
                            </div>
                            <div class="text-[10px] text-slate-400 mt-1">
                                <span>Mulai: {{ \Carbon\Carbon::parse($log->start_time)->format('d/m H:i') }}</span>
                                @if($log->end_time)
                                    <span class="ml-2">Selesai: {{ \Carbon\Carbon::parse($log->end_time)->format('d/m H:i') }}</span>
                                @endif
                            </div>
                            
                            @if($log->status === 'closed')
                                <div class="mt-1 bg-slate-50 p-2 rounded flex justify-between items-center text-[10px]">
                                    <span class="text-slate-500 font-medium">Selisih Uang Laci:</span>
                                    <span class="font-extrabold {{ $log->variance == 0 ? 'text-slate-600' : ($log->variance > 0 ? 'text-emerald-600' : 'text-rose-600') }}">
                                        {{ $log->variance == 0 ? 'Cocok' : ($log->variance > 0 ? '+' : '') . number_format($log->variance, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
