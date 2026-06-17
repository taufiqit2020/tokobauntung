@extends('layouts.preview')

@section('title', 'Pratinjau Stok Opname')
@section('report_title', 'LAPORAN PENYESUAIAN STOK OPNAME')

@section('report_meta')
<p class="text-xs text-slate-600 font-medium">Bulan: {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</p>
@endsection

@section('report_content')
<div class="space-y-6">
    <!-- Rincian Tabel -->
    <div>
        <h4 class="font-bold text-slate-800 text-xs uppercase tracking-wide mb-3 underline">Rincian Penyesuaian Stok</h4>
        <table class="w-full text-left border-collapse border border-slate-300">
            <thead>
                <tr class="bg-slate-100 text-slate-800 font-bold uppercase">
                    <th class="border border-slate-300 p-2 text-[10px]">Tanggal & Waktu</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Kode Barang</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Nama Produk</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Selisih</th>
                    <th class="border border-slate-300 p-2 text-right text-[10px]">Stok Akhir</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Alasan Penyesuaian</th>
                    <th class="border border-slate-300 p-2 text-[10px]">Petugas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($opnameLogs as $log)
                    <tr class="hover:bg-slate-50">
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-bold text-slate-700 uppercase">{{ $log->product->product_code }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] font-medium text-slate-800">{{ $log->product->name }}</td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-bold {{ $log->qty_change > 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ $log->qty_change > 0 ? '+' : '' }}{{ number_format($log->qty_change, 0, ',', '.') }} {{ $log->product->unit }}
                        </td>
                        <td class="border border-slate-300 p-2 text-right text-[10px] font-bold text-slate-900">
                            {{ number_format($log->current_stock, 0, ',', '.') }} {{ $log->product->unit }}
                        </td>
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-600">{{ $log->reason }}</td>
                        <td class="border border-slate-300 p-2 text-[10px] text-slate-500 font-semibold">{{ $log->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="border border-slate-300 p-6 text-center text-slate-400 font-medium">Belum ada riwayat stock opname yang tercatat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
