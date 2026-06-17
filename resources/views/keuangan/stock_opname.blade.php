@extends('layouts.app')

@section('title', 'Stock Opname')
@section('page_title', 'Penyesuaian Stok Fisik & Sistem')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    <!-- Left Column: New Stock Opname Form (1/3 width) -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm h-fit">
        <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide mb-4 pb-2 border-b border-slate-100 flex items-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Catat Stock Opname</span>
        </h3>

        <form action="{{ route('keuangan.stock_opname.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <!-- Product Selection -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Pilih Barang / Produk</label>
                <select name="product_id" required id="product-select" onchange="updateSystemStockInfo()"
                        class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $prod)
                        <option value="{{ $prod->id }}" data-stock="{{ $prod->stock }}" data-unit="{{ $prod->unit }}">
                            [{{ $prod->product_code }}] {{ $prod->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- System stock indicator -->
            <div class="p-3 bg-slate-50 border border-slate-200/50 rounded-xl flex justify-between items-center text-[10px] text-slate-500">
                <span>STOK TERCATAT SISTEM:</span>
                <span id="system-stock-display" class="font-extrabold text-slate-700 text-xs">-</span>
            </div>

            <!-- Actual counted stock input -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Stok Riil Fisik Terhitung</label>
                <div class="relative">
                    <input type="number" name="actual_stock" required min="0" id="actual-stock-input" oninput="calculateVariance()"
                           class="w-full p-2.5 pr-12 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-bold text-sm"
                           placeholder="Kuantitas asli di toko...">
                    <span id="unit-addon" class="absolute right-3 top-2.5 text-slate-400 font-semibold uppercase">pcs</span>
                </div>
            </div>

            <!-- Calculated Variance -->
            <div class="p-3 bg-slate-50 border border-slate-200/50 rounded-xl flex justify-between items-center text-[10px] text-slate-500">
                <span>SELISIH / PENYESUAIAN:</span>
                <span id="variance-display" class="font-extrabold text-xs">-</span>
            </div>

            <!-- Reason for variance -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Alasan Selisih / Penyesuaian</label>
                <textarea name="reason" rows="3" required
                          class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs"
                          placeholder="Contoh: Barang rusak/bocor, salah hitung saat masuk, kedaluwarsa, dll..."></textarea>
            </div>

            <!-- Submit -->
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                Simpan Penyesuaian
            </button>
        </form>
    </div>

    <!-- Right Column: Opname Logs (2/3 width) -->
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden h-fit">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Riwayat Penyesuaian Stok Opname</h3>
            <button type="button" onclick="exportExcel()" class="py-1.5 px-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-lg text-[10px] shadow-sm transition-all active:scale-95 cursor-pointer flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                </svg>
                <span>Ekspor Excel</span>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4">Tanggal</th>
                        <th class="p-4">Produk</th>
                        <th class="p-4 text-right">Selisih</th>
                        <th class="p-4 text-right">Stok Akhir</th>
                        <th class="p-4">Alasan Penyesuaian</th>
                        <th class="p-4">Petugas</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($opnameLogs as $log)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
                            <td class="p-4">
                                <span class="font-bold text-slate-900 block">{{ $log->product->name }}</span>
                                <span class="text-[9px] text-slate-400 font-semibold uppercase tracking-wider">{{ $log->product->product_code }}</span>
                            </td>
                            <td class="p-4 text-right">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold {{ $log->qty_change > 0 ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-rose-50 text-rose-700 border border-rose-100' }}">
                                    {{ $log->qty_change > 0 ? '+' : '' }}{{ number_format($log->qty_change, 0, ',', '.') }} {{ $log->product->unit }}
                                </span>
                            </td>
                            <td class="p-4 text-right font-extrabold text-slate-800">{{ number_format($log->current_stock, 0, ',', '.') }} {{ $log->product->unit }}</td>
                            <td class="p-4 max-w-[180px] truncate" title="{{ $log->reason }}">{{ $log->reason }}</td>
                            <td class="p-4 font-semibold text-slate-600">{{ $log->user->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-slate-400 font-medium">Belum ada riwayat stock opname yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($opnameLogs->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                {{ $opnameLogs->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    function updateSystemStockInfo() {
        const select = document.getElementById('product-select');
        const display = document.getElementById('system-stock-display');
        const unitAddon = document.getElementById('unit-addon');
        
        if (select.selectedIndex === 0) {
            display.innerText = '-';
            unitAddon.innerText = 'pcs';
            return;
        }

        const option = select.options[select.selectedIndex];
        const stock = option.getAttribute('data-stock');
        const unit = option.getAttribute('data-unit');

        display.innerText = `${stock} ${unit}`;
        unitAddon.innerText = unit;

        calculateVariance();
    }

    function calculateVariance() {
        const select = document.getElementById('product-select');
        const input = document.getElementById('actual-stock-input');
        const display = document.getElementById('variance-display');

        if (select.selectedIndex === 0 || !input.value) {
            display.innerText = '-';
            display.className = "font-extrabold text-slate-700 text-xs";
            return;
        }

        const option = select.options[select.selectedIndex];
        const sysStock = parseInt(option.getAttribute('data-stock'));
        const actualStock = parseInt(input.value);
        const diff = actualStock - sysStock;
        const unit = option.getAttribute('data-unit');

        if (diff === 0) {
            display.innerText = 'Tidak Ada Selisih';
            display.className = "font-extrabold text-slate-500 text-xs";
        } else if (diff > 0) {
            display.innerText = `+${diff} ${unit} (Stok Bertambah)`;
            display.className = "font-extrabold text-emerald-600 text-xs";
        } else {
            display.innerText = `${diff} ${unit} (Stok Berkurang)`;
            display.className = "font-extrabold text-rose-600 text-xs";
        }
    }

    function exportExcel() {
        window.open(`{{ route('keuangan.stock_opname') }}?export=preview`, '_blank');
    }
</script>
@endsection
