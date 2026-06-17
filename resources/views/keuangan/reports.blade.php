@extends('layouts.app')

@section('title', 'Laporan Penjualan')
@section('page_title', 'Laporan Rinci & Analisa Penjualan')

@section('content')
<div class="space-y-6">

    <!-- Report Filters Header Card -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-4">Filter Laporan Penjualan</h3>
        <form action="{{ route('keuangan.reports') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 text-xs font-semibold text-slate-500">
            <!-- Start Date -->
            <div>
                <label class="block mb-1.5 uppercase">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
            </div>

            <!-- End Date -->
            <div>
                <label class="block mb-1.5 uppercase">Tanggal Akhir</label>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
            </div>

            <!-- Cashier Filter (Multiple Selection) -->
            <div class="relative" id="cashier-dropdown-container">
                <label class="block mb-1.5 uppercase">Kasir</label>
                <button type="button" id="cashier-dropdown-btn" onclick="toggleCashierDropdown(event)"
                        class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl text-left focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium flex justify-between items-center cursor-pointer select-none">
                    <span id="cashier-selected-text">Semua Kasir</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4 text-slate-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <!-- Panel Dropdown -->
                <div id="cashier-dropdown-panel" class="absolute z-20 mt-1 w-full bg-white border border-slate-200 rounded-xl shadow-lg p-3 hidden max-h-48 overflow-y-auto space-y-2">
                    <label class="flex items-center space-x-2.5 p-1.5 hover:bg-slate-50 rounded-lg cursor-pointer">
                        <input type="checkbox" id="cashier-all-checkbox" onchange="toggleAllCashiers(this)"
                               class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500">
                        <span class="text-slate-700 font-medium select-none">Semua Kasir</span>
                    </label>
                    <div class="border-t border-slate-100 my-1"></div>
                    @foreach($cashiers as $c)
                        @php
                            $isCheck = false;
                            if (is_array(request('user_ids'))) {
                                $isCheck = in_array($c->id, request('user_ids'));
                            } elseif (request()->has('user_id') && request('user_id') != '') {
                                $isCheck = request('user_id') == $c->id;
                            }
                        @endphp
                        <label class="flex items-center space-x-2.5 p-1.5 hover:bg-slate-50 rounded-lg cursor-pointer">
                            <input type="checkbox" name="user_ids[]" value="{{ $c->id }}" onchange="updateCashierSelectedText()"
                                   {{ $isCheck ? 'checked' : '' }}
                                   class="w-4 h-4 text-indigo-600 rounded border-slate-300 focus:ring-indigo-500 cashier-checkbox">
                            <span class="text-slate-700 font-medium select-none">{{ $c->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Payment Method Filter -->
            <div>
                <label class="block mb-1.5 uppercase">Metode Pembayaran</label>
                <div class="flex space-x-2">
                    <select name="payment_method"
                            class="flex-1 p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                        <option value="">Semua Metode</option>
                        <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>TUNAI (CASH)</option>
                        <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                    </select>
                    <button type="submit" class="py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                        Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Financial Performance Stats row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Net Sales -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Total Omset Bersih</span>
                <p class="text-xl font-extrabold text-indigo-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Periode filter terpilih</span>
            </div>
            <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.958-.659-1.171-.879-1.171-2.305 0-3.182 1.172-.879 3.07-.879 4.242 0 .88.66 1.459 1.579 1.737 2.618M12 3v3m0 12v3" />
                </svg>
            </div>
        </div>

        <!-- Total Discounts -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Potongan Grosir</span>
                <p class="text-xl font-extrabold text-rose-500">Rp {{ number_format($totalDiscount, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Pemotongan harga grosir</span>
            </div>
            <div class="p-2.5 bg-rose-50 text-rose-500 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 14.25l6-6m4.5-3.75L3.75 19.5" />
                </svg>
            </div>
        </div>

        <!-- Cash Portion -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Porsi Uang Tunai</span>
                <p class="text-xl font-extrabold text-slate-800">Rp {{ number_format($cashRevenue, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total uang tunai masuk</span>
            </div>
            <div class="p-2.5 bg-slate-100 text-slate-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15M5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                </svg>
            </div>
        </div>

        <!-- QRIS Portion -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-slate-400 text-[10px] font-bold uppercase tracking-wider block">Porsi Dompet Digital QRIS</span>
                <p class="text-xl font-extrabold text-teal-600">Rp {{ number_format($qrisRevenue, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total uang masuk non-tunai</span>
            </div>
            <div class="p-2.5 bg-teal-50 text-teal-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Sales Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Daftar Struk Transaksi Penjualan</h3>
            <button type="button" onclick="exportExcel()" class="py-2 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer flex items-center space-x-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                </svg>
                <span>Ekspor Excel</span>
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4">No. Invoice</th>
                        <th class="p-4">Tanggal & Waktu</th>
                        <th class="p-4">Kasir</th>
                        <th class="p-4 text-center">Pembayaran</th>
                        <th class="p-4 text-right">Subtotal</th>
                        <th class="p-4 text-right">Grosir</th>
                        <th class="p-4 text-right">Total Akhir</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($transactions as $trans)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 font-bold text-slate-900 tracking-wide">{{ $trans->invoice_number }}</td>
                            <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($trans->created_at)->isoFormat('D MMMM YYYY, H:mm') }} WITA</td>
                            <td class="p-4 font-semibold text-slate-700">{{ $trans->user->name }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase {{ $trans->payment_method === 'cash' ? 'bg-slate-100 text-slate-700 border border-slate-200' : 'bg-teal-50 text-teal-700 border border-teal-100' }}">
                                    {{ $trans->payment_method }}
                                </span>
                            </td>
                            <td class="p-4 text-right font-medium text-slate-500">Rp {{ number_format($trans->subtotal, 0, ',', '.') }}</td>
                            <td class="p-4 text-right font-medium text-rose-500">
                                {{ $trans->discount > 0 ? 'Rp ' . number_format($trans->discount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="p-4 text-right font-extrabold text-indigo-600 text-sm">Rp {{ number_format($trans->grand_total, 0, ',', '.') }}</td>
                            <td class="p-4 text-center">
                                <a href="{{ route('keuangan.reports.print', $trans->id) }}"
                                   class="inline-flex items-center space-x-1 py-1 px-2.5 bg-indigo-50 border border-indigo-200 hover:border-indigo-500 hover:text-indigo-600 rounded-lg text-indigo-700 font-bold transition-all text-[10px]"
                                   title="Cetak Struk">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.821V21h10.56v-7.179M9 3.75h6M18 10.5h.008v.008H18V10.5Zm-1.8 1.35H7.8M6 6.75h12v6H6v-6Z" />
                                    </svg>
                                    <span>Cetak</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-slate-400 font-medium">Tidak ada data penjualan untuk periode filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($transactions->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    // Toggle cashier dropdown visibility
    function toggleCashierDropdown(event) {
        event.stopPropagation();
        const panel = document.getElementById('cashier-dropdown-panel');
        if (panel.classList.contains('hidden')) {
            panel.classList.remove('hidden');
        } else {
            panel.classList.add('hidden');
        }
    }

    // Toggle all cashiers
    function toggleAllCashiers(checkbox) {
        const checkboxes = document.querySelectorAll('.cashier-checkbox');
        checkboxes.forEach(cb => {
            cb.checked = checkbox.checked;
        });
        updateCashierSelectedText();
    }

    // Update selected cashiers count/text
    function updateCashierSelectedText() {
        const checkboxes = document.querySelectorAll('.cashier-checkbox');
        const checkedCount = Array.from(checkboxes).filter(cb => cb.checked).length;
        const totalCount = checkboxes.length;
        const textElement = document.getElementById('cashier-selected-text');
        const allCheckbox = document.getElementById('cashier-all-checkbox');

        if (checkedCount === 0) {
            textElement.innerText = "Semua Kasir";
            if (allCheckbox) allCheckbox.checked = true;
        } else if (checkedCount === totalCount) {
            textElement.innerText = "Semua Kasir";
            if (allCheckbox) allCheckbox.checked = true;
        } else if (checkedCount === 1) {
            const checkedCb = Array.from(checkboxes).find(cb => cb.checked);
            textElement.innerText = checkedCb.nextElementSibling.innerText;
            if (allCheckbox) allCheckbox.checked = false;
        } else {
            textElement.innerText = checkedCount + " Kasir Terpilih";
            if (allCheckbox) allCheckbox.checked = false;
        }
    }

    // Export Excel function
    function exportExcel() {
        const form = document.querySelector('form');
        const formData = new FormData(form);
        const params = new URLSearchParams();

        for (const [key, value] of formData.entries()) {
            if (key.endsWith('[]')) {
                params.append(key, value);
            } else {
                params.set(key, value);
            }
        }

        // Add export mode
        params.set('export', 'excel');

        const url = `{{ route('keuangan.reports') }}?${params.toString()}`;
        window.location.href = url;
    }

    // Close cashier dropdown on click outside
    document.addEventListener('click', function (event) {
        const container = document.getElementById('cashier-dropdown-container');
        const panel = document.getElementById('cashier-dropdown-panel');
        if (container && panel && !container.contains(event.target)) {
            panel.classList.add('hidden');
        }
    });

    // Run on document load
    document.addEventListener('DOMContentLoaded', () => {
        updateCashierSelectedText();
    });
</script>
@endsection
