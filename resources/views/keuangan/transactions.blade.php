@extends('layouts.app')

@section('title', 'Riwayat Transaksi Kasir')
@section('page_title', 'Riwayat & Detail Transaksi Kasir')

@section('content')
<div class="space-y-6">

    <!-- Filters -->
    <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider mb-4">Filter Transaksi</h3>
        <form id="filter-transactions-form" action="{{ route('keuangan.transactions') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 text-xs font-semibold text-slate-500">
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

            <!-- Cashier Filter -->
            <div>
                <label class="block mb-1.5 uppercase">Kasir</label>
                <select name="user_id" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                    <option value="">Semua Kasir</option>
                    @foreach($cashiers as $c)
                        <option value="{{ $c->id }}" {{ request('user_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Payment Method Filter -->
            <div>
                <label class="block mb-1.5 uppercase">Metode Pembayaran</label>
                <select name="payment_method" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                    <option value="">Semua Metode</option>
                    <option value="cash" {{ request('payment_method') === 'cash' ? 'selected' : '' }}>TUNAI (CASH)</option>
                    <option value="qris" {{ request('payment_method') === 'qris' ? 'selected' : '' }}>QRIS</option>
                </select>
            </div>

            <!-- Search Invoice & Action -->
            <div>
                <label class="block mb-1.5 uppercase">Cari Nomor Struk</label>
                <div class="flex space-x-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: TRX-..."
                           class="flex-1 p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium">
                    <button type="submit" class="py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Stats row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Transactions -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Transaksi</span>
                <p class="text-xl font-extrabold text-slate-800">{{ number_format($totalTransactions) }}</p>
                <span class="text-[9px] text-slate-400">Transaksi tercatat</span>
            </div>
            <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
            </div>
        </div>

        <!-- Net Sales -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Omset</span>
                <p class="text-xl font-extrabold text-indigo-600">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Kumulatif omset periode</span>
            </div>
            <div class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-1.958-.659-1.171-.879-1.171-2.305 0-3.182 1.172-.879 3.07-.879 4.242 0 .88.66 1.459 1.579 1.737 2.618M12 3v3m0 12v3" />
                </svg>
            </div>
        </div>

        <!-- Cash Sales -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Uang Tunai (Cash)</span>
                <p class="text-xl font-extrabold text-emerald-600">Rp {{ number_format($totalCash, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total pembayaran tunai</span>
            </div>
            <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M4.5 19.5h15M5.25 4.5V19.5m13.5-15V19.5m-10.5-15v10.5m4.5-10.5v10.5m-6.75 3h9" />
                </svg>
            </div>
        </div>

        <!-- QRIS Sales -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">QRIS</span>
                <p class="text-xl font-extrabold text-teal-600">Rp {{ number_format($totalQris, 0, ',', '.') }}</p>
                <span class="text-[9px] text-slate-400">Total pembayaran QRIS</span>
            </div>
            <div class="p-2.5 bg-teal-50 text-teal-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Daftar Transaksi Kasir</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4 text-center" style="width: 50px;">No.</th>
                        <th class="p-4">Tanggal & Waktu</th>
                        <th class="p-4">No. Invoice</th>
                        <th class="p-4">Kasir</th>
                        <th class="p-4 text-center">Metode Pembayaran</th>
                        <th class="p-4 text-right">Potongan</th>
                        <th class="p-4 text-right">Total Akhir (Omset)</th>
                        <th class="p-4 text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($transactions as $index => $trx)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 font-bold text-slate-400 text-center">
                                {{ $index + 1 + (($transactions->currentPage() - 1) * $transactions->perPage()) }}
                            </td>
                            <td class="p-4 font-bold text-slate-900 tracking-wide">
                                {{ \Carbon\Carbon::parse($trx->created_at)->isoFormat('D MMMM YYYY, HH:mm') }} WITA
                            </td>
                            <td class="p-4 font-extrabold text-slate-800 tracking-wider">
                                {{ $trx->invoice_number }}
                            </td>
                            <td class="p-4 font-semibold text-slate-700">
                                {{ $trx->user ? $trx->user->name : 'N/A' }}
                            </td>
                            <td class="p-4 text-center">
                                @if($trx->payment_method === 'cash')
                                    <span class="inline-block py-1 px-3 bg-emerald-50 text-emerald-700 font-extrabold rounded-full text-[10px] uppercase border border-emerald-100 shadow-sm">
                                        Tunai (Cash)
                                    </span>
                                @elseif($trx->payment_method === 'qris')
                                    <span class="inline-block py-1 px-3 bg-teal-50 text-teal-700 font-extrabold rounded-full text-[10px] uppercase border border-teal-100 shadow-sm">
                                        QRIS
                                    </span>
                                @else
                                    <span class="inline-block py-1 px-3 bg-slate-50 text-slate-600 font-extrabold rounded-full text-[10px] uppercase border border-slate-100 shadow-sm">
                                        {{ strtoupper($trx->payment_method) }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right font-medium text-rose-500">
                                {{ $trx->discount > 0 ? 'Rp ' . number_format($trx->discount, 0, ',', '.') : '-' }}
                            </td>
                            <td class="p-4 text-right font-extrabold text-indigo-600 text-sm">
                                Rp {{ number_format($trx->grand_total, 0, ',', '.') }}
                            </td>
                            <td class="p-4 text-center flex justify-center space-x-2">
                                <!-- View Details -->
                                <button type="button" onclick="showTrxDetails({{ $trx->id }})"
                                        class="py-1.5 px-3 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold rounded-xl text-[10px] shadow-sm transition-all active:scale-95 cursor-pointer">
                                    Detail
                                </button>
                                <!-- Print Struk -->
                                <button type="button" onclick="printThermal({{ $trx->id }})"
                                        class="py-1.5 px-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-[10px] shadow-sm transition-all active:scale-95 cursor-pointer flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.258a1.791 1.791 0 01-1.764 2.117H7.874a1.791 1.791 0 01-1.764-2.117L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0-1.105-.895-2-2-2h-11c-1.105 0-2 .895-2 2M19.5 10.5a2.25 2.25 0 012.25 2.25v5.625a1.5 1.5 0 01-1.5 1.5h-1.5M19.5 10.5v3.75m-15-3.75a2.25 2.25 0 00-2.25 2.25v5.625a1.5 1.5 0 00 1.5 1.5h1.5M4.5 10.5v3.75m11.25-3.75h-7.5V3c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v6.75Z" />
                                    </svg>
                                    <span>Cetak</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-slate-400 font-medium">Tidak ada data transaksi kasir untuk periode filter ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/30">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Transaction Details Modal -->
<div id="trx-detail-modal" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden flex flex-col max-h-[85vh] scale-95 transition-all duration-300">
        <!-- Header -->
        <div class="p-4 bg-slate-900 text-white flex justify-between items-center">
            <div>
                <h3 class="font-extrabold text-sm uppercase tracking-wide">Detail Struk Transaksi</h3>
                <p id="modal-invoice-number" class="text-[10px] text-slate-300 font-mono mt-0.5">TRX-...</p>
            </div>
            <button onclick="closeTrxDetails()" class="text-slate-400 hover:text-white transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Body (Simulated Thermal Struk Scroll) -->
        <div class="flex-1 overflow-y-auto p-6 bg-amber-50/10 space-y-4 text-xs text-slate-800">
            <!-- Shop Header -->
            <div class="text-center space-y-1 pb-3 border-b border-dashed border-slate-300">
                <h4 class="font-extrabold text-sm uppercase text-slate-900 tracking-wider">
                    {{ \App\Models\Setting::getValue('shop_name', 'BAUNTUNGPOS') }}
                </h4>
                <p class="text-[10px] text-slate-500 uppercase font-semibold">
                    {{ \App\Models\Setting::getValue('shop_subtitle', 'TOKO PLASTIK & SEMBAKO') }}
                </p>
                <p class="text-[10px] text-slate-400 font-medium">
                    {{ \App\Models\Setting::getValue('shop_address', 'Jl. Panglima Batur, Banjarbaru') }}
                </p>
                <p class="text-[10px] text-slate-400 font-medium">
                    Telp: <span id="modal-shop-phone">0851 6665 7171</span>
                </p>
            </div>

            <!-- Trx Meta Info -->
            <div class="space-y-1 pb-3 border-b border-dashed border-slate-300 font-medium text-slate-600">
                <div class="flex justify-between">
                    <span>Waktu:</span>
                    <span id="modal-trx-time" class="font-bold text-slate-800">...</span>
                </div>
                <div class="flex justify-between">
                    <span>Kasir:</span>
                    <span id="modal-trx-cashier" class="font-bold text-slate-800">...</span>
                </div>
                <div class="flex justify-between">
                    <span>Metode:</span>
                    <span id="modal-trx-method" class="font-bold text-slate-800 uppercase">...</span>
                </div>
            </div>

            <!-- Items Table -->
            <div class="space-y-2">
                <div class="font-bold text-slate-900 uppercase text-[9px] tracking-wide mb-1">Rincian Barang</div>
                <div id="modal-items-list" class="space-y-2 divide-y divide-dashed divide-slate-200">
                    <!-- Dynamic Items insertion -->
                </div>
            </div>

            <!-- Totals -->
            <div class="border-t border-dashed border-slate-300 pt-3 space-y-1.5 font-semibold text-slate-700">
                <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span id="modal-subtotal" class="font-bold text-slate-900">Rp 0</span>
                </div>
                <div id="modal-discount-row" class="flex justify-between text-rose-500 hidden">
                    <span>Potongan Grosir:</span>
                    <span id="modal-discount">Rp 0</span>
                </div>
                <div class="flex justify-between text-indigo-600 text-sm border-t border-dashed border-slate-200 pt-1.5">
                    <span class="font-extrabold">TOTAL AKHIR:</span>
                    <span id="modal-grand-total" class="font-extrabold">Rp 0</span>
                </div>
                <div class="flex justify-between text-slate-500 text-[10px] pt-1">
                    <span>Diterima (Bayar):</span>
                    <span id="modal-cash-amount">Rp 0</span>
                </div>
                <div class="flex justify-between text-slate-500 text-[10px]">
                    <span>Kembalian:</span>
                    <span id="modal-change-amount">Rp 0</span>
                </div>
            </div>

            <!-- Footer Message -->
            <div class="text-center pt-3 border-t border-dashed border-slate-300 text-[10px] text-slate-400 font-medium italic">
                Terima kasih atas kunjungan Anda!<br>
                Barang yang sudah dibeli tidak dapat ditukar/dikembalikan.
            </div>
        </div>

        <!-- Actions -->
        <div class="p-3 bg-slate-50 border-t border-slate-100 flex space-x-2">
            <button onclick="closeTrxDetails()"
                    class="flex-1 py-2 px-3 bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold rounded-xl text-xs transition-all active:scale-95 cursor-pointer text-center">
                Tutup
            </button>
            <button id="modal-print-btn" onclick=""
                    class="flex-1 py-2 px-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-md transition-all active:scale-95 cursor-pointer flex items-center justify-center space-x-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.258a1.791 1.791 0 01-1.764 2.117H7.874a1.791 1.791 0 01-1.764-2.117L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0-1.105-.895-2-2-2h-11c-1.105 0-2 .895-2 2M19.5 10.5a2.25 2.25 0 012.25 2.25v5.625a1.5 1.5 0 01-1.5 1.5h-1.5M19.5 10.5v3.75m-15-3.75a2.25 2.25 0 00-2.25 2.25v5.625a1.5 1.5 0 00 1.5 1.5h1.5M4.5 10.5v3.75m11.25-3.75h-7.5V3c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v6.75Z" />
                </svg>
                <span>Cetak Struk</span>
            </button>
        </div>
    </div>
</div>

<script>
    // Show Transaction Details
    function showTrxDetails(id) {
        const modal = document.getElementById('trx-detail-modal');
        const modalContent = modal.querySelector('.bg-white');

        // Reset details
        document.getElementById('modal-invoice-number').innerText = 'Loading...';
        document.getElementById('modal-items-list').innerHTML = '<p class="p-4 text-center text-slate-400">Loading items...</p>';

        modal.style.display = 'flex';
        modalContent.classList.remove('scale-95');
        modalContent.classList.add('scale-100');

        fetch(`/keuangan/transactions/${id}/details`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modal-invoice-number').innerText = data.invoice_number;
                
                // Formatted date and time
                const dateOptions = { day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' };
                const rawDate = new Date(data.created_at);
                const formattedDate = rawDate.toLocaleDateString('id-ID', dateOptions) + ' WITA';
                document.getElementById('modal-trx-time').innerText = formattedDate;
                
                document.getElementById('modal-trx-cashier').innerText = data.user ? data.user.name : 'N/A';
                document.getElementById('modal-trx-method').innerText = data.payment_method === 'cash' ? 'TUNAI (CASH)' : 'QRIS';
                
                // Setup print button action
                document.getElementById('modal-print-btn').setAttribute('onclick', `printThermal(${data.id})`);

                // Items list
                let itemsHtml = '';
                data.details.forEach(detail => {
                    const prodName = detail.product ? detail.product.name : 'Barang Terhapus';
                    const prodCode = detail.product ? detail.product.product_code : 'N/A';
                    const unit = detail.product ? (detail.product.unit || 'pcs') : 'pcs';
                    const totalVal = detail.qty * detail.sell_price;
                    
                    itemsHtml += `
                        <div class="pt-2 text-[11px]">
                            <div class="font-bold text-slate-900">[${prodCode}] ${prodName}</div>
                            <div class="flex justify-between text-slate-500 mt-0.5">
                                <span>${detail.qty} ${unit} x Rp ${formatRupiah(detail.sell_price)}</span>
                                <span class="font-bold text-slate-800">Rp ${formatRupiah(totalVal)}</span>
                            </div>
                        </div>
                    `;
                });
                document.getElementById('modal-items-list').innerHTML = itemsHtml;

                // Totals
                document.getElementById('modal-subtotal').innerText = 'Rp ' + formatRupiah(data.subtotal);
                if (data.discount > 0) {
                    document.getElementById('modal-discount-row').classList.remove('hidden');
                    document.getElementById('modal-discount').innerText = '-Rp ' + formatRupiah(data.discount);
                } else {
                    document.getElementById('modal-discount-row').classList.add('hidden');
                }
                document.getElementById('modal-grand-total').innerText = 'Rp ' + formatRupiah(data.grand_total);
                document.getElementById('modal-cash-amount').innerText = 'Rp ' + formatRupiah(data.cash_amount || data.grand_total);
                document.getElementById('modal-change-amount').innerText = 'Rp ' + formatRupiah(data.change_amount || 0);
            })
            .catch(err => {
                console.error(err);
                document.getElementById('modal-items-list').innerHTML = '<p class="p-4 text-center text-red-500">Gagal memuat detail transaksi.</p>';
            });
    }

    // Close Transaction Details
    function closeTrxDetails() {
        const modal = document.getElementById('trx-detail-modal');
        const modalContent = modal.querySelector('.bg-white');
        
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 150);
    }

    // Helper format Rupiah
    function formatRupiah(num) {
        return parseInt(num).toLocaleString('id-ID');
    }

    // Print thermal simulated receipt popup
    function printThermal(id) {
        const width = 350;
        const height = 650;
        const left = (screen.width / 2) - (width / 2);
        const top = (screen.height / 2) - (height / 2);
        
        window.open(
            `/keuangan/transactions/${id}/print-thermal`, 
            'Cetak Struk Thermal', 
            `width=${width},height=${height},left=${left},top=${top},toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes`
        );
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeTrxDetails();
        }
    });

    // Close modal on click outside content
    document.getElementById('trx-detail-modal').addEventListener('click', function(event) {
        if (event.target === this) {
            closeTrxDetails();
        }
    });
</script>
@endsection
