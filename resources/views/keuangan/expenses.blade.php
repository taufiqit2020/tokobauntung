@extends('layouts.app')

@section('title', 'Pencatatan Pengeluaran')
@section('page_title', 'Biaya Operasional Toko')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column: New Expense Form (1/3 width) -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4 pb-2 border-b border-slate-100 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Catat Pengeluaran</span>
        </h3>

        <form action="{{ route('keuangan.expenses.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <!-- Category Selection -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Kategori Pengeluaran</label>
                <select name="category" required
                        class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Expense date -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Tanggal Pengeluaran</label>
                <input type="date" name="expense_date" value="{{ date('Y-m-d') }}" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
            </div>

            <!-- Amount -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nominal Pengeluaran</label>
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
                <textarea name="description" rows="3" required
                          class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs"
                          placeholder="Tulis keterangan belanja pengeluaran secara rinci (misal: Token Listrik 100K + Admin)..."></textarea>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                Simpan Pengeluaran
            </button>
        </form>
    </div>

    <!-- Right Column: Expense Logs (2/3 width) -->
    <div class="lg:col-span-2 space-y-6">
        
        <!-- Stats Badge -->
        <div class="bg-gradient-to-r from-slate-900 to-indigo-950 text-white p-6 rounded-2xl shadow-md flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-indigo-300 text-[10px] font-bold uppercase tracking-wider block">Pengeluaran Bulan Ini</span>
                <p class="text-3xl font-extrabold">Rp {{ number_format($totalExpenseThisMonth, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total kumulatif biaya operasional non-stok</span>
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
                <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Daftar Pengeluaran Toko</h3>
                <!-- Simple category filter & Excel export buttons -->
                <div class="flex items-center space-x-2">
                    <form action="{{ route('keuangan.expenses') }}" method="GET" class="m-0">
                        <select name="category" id="category-filter-select" onchange="this.form.submit()"
                                class="px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-[10px] font-bold focus:outline-none text-slate-600 uppercase">
                            <option value="">Semua Biaya</option>
                            @foreach($categories as $c)
                                <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                            @endforeach
                        </select>
                    </form>
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
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Keterangan</th>
                            <th class="p-4 text-right">Nominal</th>
                            <th class="p-4">Petugas</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @forelse($expenses as $exp)
                            <tr class="hover:bg-slate-50/50 transition-all">
                                <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($exp->expense_date)->format('d/m/Y') }}</td>
                                <td class="p-4 font-bold text-indigo-600 uppercase tracking-wide">{{ $exp->category }}</td>
                                <td class="p-4 font-medium text-slate-800">{{ $exp->description }}</td>
                                <td class="p-4 text-right font-extrabold text-slate-900">Rp {{ number_format($exp->amount, 0, ',', '.') }}</td>
                                <td class="p-4 text-slate-500 font-semibold">{{ $exp->user->name }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-slate-400 font-medium">Belum ada catatan biaya pengeluaran toko.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($expenses->hasPages())
                <div class="p-4 border-t border-slate-100 bg-slate-50">
                    {{ $expenses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function exportExcel() {
        const select = document.getElementById('category-filter-select');
        const params = new URLSearchParams();
        if (select && select.value) {
            params.set('category', select.value);
        }
        params.set('export', 'excel');
        window.location.href = `{{ route('keuangan.expenses') }}?${params.toString()}`;
    }
</script>
@endsection
