@extends('layouts.app')

@section('title', 'Pencatatan Pemasukan Es Teguk')
@section('page_title', 'Pemasukan ES TEGUK')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column: New Income Form (1/3 width) -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4 pb-2 border-b border-slate-100 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Catat Pemasukan</span>
        </h3>

        <form action="{{ route('keuangan.es_teguk.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            
            <!-- Income date -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Tanggal Pemasukan</label>
                <input type="date" name="income_date" value="{{ date('Y-m-d') }}" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nominal Pemasukan</label>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-400 font-bold">Rp</span>
                    <input type="number" name="amount" required min="1"
                           class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-bold text-sm"
                           placeholder="Contoh: 150000">
                </div>
            </div>

            <!-- Description -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Deskripsi Detail</label>
                <textarea name="description" rows="3"
                          class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs"
                          placeholder="Tulis keterangan detail pemasukan (misal: Penjualan Harian Es Teguk)..."></textarea>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                Simpan Pemasukan
            </button>
        </form>
    </div>

    <!-- Right Column: Income Logs (2/3 width) -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Stats Badge -->
        <div class="bg-gradient-to-r from-slate-900 to-indigo-950 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-indigo-300 text-[10px] font-bold uppercase tracking-wider block">Pemasukan Es Teguk Bulan Ini</span>
                <p class="text-3xl font-extrabold">Rp {{ number_format($totalIncomeThisMonth, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total kumulatif pemasukan bisnis Es Teguk</span>
            </div>
            <div class="p-3.5 bg-white/10 text-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
            </div>
        </div>

        <!-- Table List -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
            <div class="p-5 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-slate-50/50">
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Daftar Pemasukan Es Teguk</h3>
                <div class="flex items-center space-x-2">
                    <button type="button" onclick="exportExcel()" class="py-1.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-[10px] shadow-sm transition-all active:scale-95 cursor-pointer flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                        </svg>
                        <span>Excel</span>
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                            <th class="p-4">Tanggal</th>
                            <th class="p-4">Keterangan</th>
                            <th class="p-4 text-right">Nominal</th>
                            <th class="p-4">Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($incomes as $inc)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($inc->income_date)->format('d/m/Y') }}</td>
                                <td class="p-4 font-medium text-slate-800">{{ $inc->description ?: '-' }}</td>
                                <td class="p-4 text-right font-extrabold text-slate-900">Rp {{ number_format($inc->amount, 0, ',', '.') }}</td>
                                <td class="p-4 text-slate-500 font-semibold">{{ $inc->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-8 text-center text-slate-400 font-medium">Belum ada catatan pemasukan Es Teguk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($incomes->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50">
                    {{ $incomes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function exportExcel() {
        const params = new URLSearchParams();
        params.set('export', 'excel');
        window.location.href = `{{ route('keuangan.es_teguk') }}?${params.toString()}`;
    }
</script>
@endsection
