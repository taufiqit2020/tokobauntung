@extends('layouts.preview')

@section('title', 'Pratinjau Pemasukan Es Teguk')
@section('report_title', 'LAPORAN PEMASUKAN ES TEGUK')

@section('report_meta')
<p class="text-xs text-slate-600 font-medium">Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
@endsection

@section('report_content')
<div class="space-y-6">
    <!-- Ringkasan Card -->
    <div class="border border-slate-200 rounded-xl p-4 bg-slate-50 max-w-sm">
        <h4 class="font-bold text-slate-700 text-xs uppercase tracking-wider mb-2">Ringkasan Pemasukan Bulan Ini</h4>
        <div class="flex justify-between items-center">
            <span class="text-slate-500 font-medium">Total Pemasukan:</span>
            <span class="font-extrabold text-emerald-600 text-sm">Rp {{ number_format($totalIncomeThisMonth, 0, ',', '.') }}</span>
        </div>
    </div>

    <!-- Rincian Tabel -->
    <div>
        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3 underline">Rincian Pemasukan</h4>
        <table class="w-full text-left border-collapse border border-slate-300">
            <thead>
                <tr class="bg-slate-100 text-slate-800 font-bold uppercase">
                    <th class="border border-slate-300 p-2 text-[10px]">Tanggal</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Keterangan / Deskripsi</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Nominal (Rp)</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @php $grandTotal = 0; @endphp
                @forelse($incomes as $inc)
                    @php $grandTotal += $inc->amount; @endphp
                    <tr class="hover:bg-slate-50">
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-600">{{ \Carbon\Carbon::parse($inc->income_date)->format('d/m/Y') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-medium text-slate-800">{{ $inc->description ?: '-' }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-bold text-slate-900">Rp {{ number_format($inc->amount, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500 font-semibold">{{ $inc->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border border-slate-300 p-6 text-center text-slate-400 font-medium">Belum ada catatan pemasukan Es Teguk.</td>
                    </tr>
                @endforelse
                @if(count($incomes) > 0)
                    <tr class="font-bold bg-slate-50">
                        <td colspan="2" class="border border-slate-300 p-2 text-right text-[10px]">TOTAL PEMASUKAN FILTER:</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] text-emerald-600">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        <td class="border border-slate-300 p-2">&nbsp;</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
