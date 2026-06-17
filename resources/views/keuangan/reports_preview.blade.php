@extends('layouts.preview')

@section('title', 'Pratinjau Laporan Penjualan')
@section('report_title', 'LAPORAN PENJUALAN')

@section('report_meta')
@php
    $selectedCashierNames = 'Semua Kasir';
    if (request()->filled('user_ids') && is_array(request('user_ids'))) {
        $selectedCashierNames = \App\Models\User::whereIn('id', request('user_ids'))->pluck('name')->implode(', ');
    }
    $selectedPaymentMethod = 'Semua Metode';
    if (request()->filled('payment_method')) {
        $selectedPaymentMethod = request('payment_method') === 'cash' ? 'TUNAI (CASH)' : 'QRIS';
    }
@endphp
<p class="text-xs text-slate-600 font-medium">Periode: {{ $startDate->translatedFormat('d F Y') }} s.d. {{ $endDate->translatedFormat('d F Y') }}</p>
<p class="text-[10px] text-slate-500 font-medium">Kasir: {{ $selectedCashierNames }} | Metode: {{ $selectedPaymentMethod }}</p>
@endsection

@section('report_content')
<div class="space-y-6">
    <!-- Ringkasan Kinerja Penjualan -->
    <div>
        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3 underline">Ringkasan Kinerja Periode Ini</h4>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50">
                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Omset Bersih</span>
                <span class="font-extrabold text-indigo-600 text-[13px]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50">
                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Potongan Grosir</span>
                <span class="font-extrabold text-rose-600 text-[13px]">Rp {{ number_format($totalDiscount, 0, ',', '.') }}</span>
            </div>
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50">
                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Metode Tunai</span>
                <span class="font-bold text-slate-700 text-[13px]">Rp {{ number_format($cashRevenue, 0, ',', '.') }}</span>
            </div>
            <div class="border border-slate-200 rounded-xl p-3 bg-slate-50">
                <span class="text-[9px] text-slate-400 font-bold uppercase tracking-wider block">Metode QRIS</span>
                <span class="font-bold text-teal-600 text-[13px]">Rp {{ number_format($qrisRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Rincian Tabel -->
    <div>
        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3 underline">Rincian Transaksi Penjualan</h4>
        <table class="w-full text-left border-collapse border border-slate-300">
            <thead>
                <tr class="bg-slate-100 text-slate-800 font-bold uppercase">
                    <th class="border border-slate-300 p-2 text-[10px]">No. Invoice</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Tanggal & Waktu</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Kasir</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Metode</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Subtotal (Rp)</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Grosir (Rp)</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Total Akhir (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $trans)
                    <tr class="hover:bg-slate-50">
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-700 font-semibold">{{ $trans->invoice_number }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500">{{ \Carbon\Carbon::parse($trans->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-medium text-slate-800">{{ $trans->user->name }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] text-center uppercase font-bold text-slate-600">{{ $trans->payment_method }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-semibold text-slate-900">{{ number_format($trans->subtotal, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] text-rose-500">-{{ number_format($trans->discount, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-bold text-indigo-700">Rp {{ number_format($trans->grand_total, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-slate-300 p-6 text-center text-slate-400 font-medium">Tidak ada data penjualan untuk periode filter ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
