@extends('layouts.preview')

@section('title', 'Pratinjau Pengeluaran Toko')
@section('report_title', 'LAPORAN BIAYA OPERASIONAL TOKO')

@section('report_meta')
@php
    $selectedCategory = 'Semua Biaya';
    if (request()->filled('category')) {
        $selectedCategory = strtoupper(request('category'));
    }
@endphp
<p class="text-xs text-slate-600 font-medium">Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }} | Kategori Filter: {{ $selectedCategory }}</p>
@endsection

@section('report_content')
<div class="space-y-6">
    <!-- Ringkasan Card -->
    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 max-w-sm">
        <h4 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-2">Ringkasan Pengeluaran Bulan Ini</h4>
        <div class="flex justify-between items-center">
            <span class="text-slate-500 font-medium">Total Pengeluaran:</span>
            <span class="font-extrabold text-rose-600 text-sm">Rp {{ number_format($totalExpenseThisMonth, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Rincian Tabel -->
    <div>
        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3 underline">Rincian Pengeluaran</h4>
        <table class="w-full text-left border-collapse border border-slate-300">
            <thead>
                <tr class="bg-slate-100 text-slate-800 font-bold uppercase">
                    <th class="border border-slate-300 p-2 text-[10px]">Tanggal</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Kategori</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Keterangan / Deskripsi</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Nominal (Rp)</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @forelse($expenses as $exp)
                    @php $grandTotal += $exp->amount; @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500">{{ \Carbon\Carbon::parse($exp->expense_date)->format('d/m/Y') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-bold text-indigo-600 uppercase tracking-wide">{{ $exp->category }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-medium text-slate-800">{{ $exp->description }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-extrabold text-slate-900">Rp {{ number_format($exp->amount, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500 font-semibold">{{ $exp->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-slate-300 p-6 text-center text-slate-400 font-medium">Belum ada catatan biaya pengeluaran toko.</td>
                    </tr>
                @endforelse
                @if(count($expenses) > 0)
                    <tr class="font-bold bg-slate-50">
                        <td colspan="3" class="border border-slate-300 p-2 text-right text-[10px]">TOTAL PENGELUARAN FILTER:</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] text-rose-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2">&nbsp;</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
