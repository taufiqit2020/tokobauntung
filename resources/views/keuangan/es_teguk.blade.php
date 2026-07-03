@extends('layouts.app')

@section('title', 'Pencatatan Pemasukan Es Teguk')
@section('page_title', 'Pemasukan ES TEGUK')

@push('styles')
<style>
    /* ===== ES TEGUK PAGE STYLES ===== */
    .esteguk-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 24px;
    }
    @media (min-width: 1024px) {
        .esteguk-grid {
            grid-template-columns: 320px 1fr;
        }
    }

    /* Flash */
    .flash-success {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 14px;
        padding: 12px 18px;
        margin-bottom: 20px;
        animation: fadeOut 4s forwards;
    }
    @keyframes fadeOut {
        0%   { opacity: 1; }
        80%  { opacity: 1; }
        100% { opacity: 0; height: 0; padding: 0; margin: 0; overflow: hidden; }
    }
    .flash-success span { font-size: 13px; font-weight: 600; color: #065f46; }

    /* ===== FORM CARD ===== */
    .form-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 1px 8px rgba(0,0,0,0.06);
        height: fit-content;
    }
    .form-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 20px;
    }
    .form-icon {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: linear-gradient(135deg, #06b6d4, #2563eb);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 3px 10px rgba(37,99,235,0.3);
    }
    .form-card-header h3 { font-size: 14px; font-weight: 700; color: #0f172a; }
    .form-card-header p  { font-size: 10px; color: #94a3b8; margin-top: 2px; }

    .form-label {
        display: block;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #64748b;
        margin-bottom: 6px;
    }
    .form-input {
        width: 100%;
        padding: 10px 12px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 13px;
        font-weight: 500;
        color: #1e293b;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .form-input:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6,182,212,0.12);
    }
    .form-input-rp {
        width: 100%;
        padding: 10px 12px 10px 40px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        font-family: inherit;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .form-input-rp:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6,182,212,0.12);
    }
    .input-group { position: relative; }
    .input-prefix {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
    }
    .form-textarea {
        width: 100%;
        padding: 10px 12px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-size: 12px;
        color: #1e293b;
        font-family: inherit;
        resize: none;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-textarea:focus {
        border-color: #06b6d4;
        box-shadow: 0 0 0 3px rgba(6,182,212,0.12);
    }
    .form-field { margin-bottom: 16px; }

    .btn-save {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #06b6d4, #2563eb);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        letter-spacing: 0.03em;
        box-shadow: 0 4px 14px rgba(37,99,235,0.35);
        transition: opacity 0.2s, transform 0.1s;
        font-family: inherit;
        margin-top: 4px;
    }
    .btn-save:hover { opacity: 0.9; }
    .btn-save:active { transform: scale(0.98); }

    /* ===== RIGHT COLUMN ===== */
    .right-col { display: flex; flex-direction: column; gap: 20px; }

    /* BANNER */
    .banner {
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0e4a6e 100%);
        color: white;
        padding: 24px 28px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 4px 20px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }
    .banner::before {
        content: '';
        position: absolute;
        right: -30px;
        top: -30px;
        width: 120px;
        height: 120px;
        background: rgba(6,182,212,0.08);
        border-radius: 50%;
    }
    .banner::after {
        content: '';
        position: absolute;
        right: 10px;
        bottom: -20px;
        width: 80px;
        height: 80px;
        background: rgba(37,99,235,0.1);
        border-radius: 50%;
    }
    .banner-text { position: relative; z-index: 1; }
    .banner-label {
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #67e8f9;
        margin-bottom: 6px;
    }
    .banner-amount {
        font-size: 30px;
        font-weight: 800;
        letter-spacing: -0.02em;
        line-height: 1;
    }
    .banner-sub {
        font-size: 9px;
        color: #64748b;
        margin-top: 6px;
    }
    .banner-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.08);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        position: relative;
        z-index: 1;
    }

    /* TABLE CARD */
    .table-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 1px 8px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    .table-card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .table-card-title {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .table-icon {
        width: 30px;
        height: 30px;
        background: #e0f2fe;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .table-card-title h3 { font-size: 13px; font-weight: 700; color: #0f172a; }

    .btn-group { display: flex; gap: 8px; }
    .btn-cetak {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #059669;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s;
    }
    .btn-cetak:hover { background: #047857; }
    .btn-excel-sm {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 10px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s;
    }
    .btn-excel-sm:hover { background: #4338ca; }

    /* DATA TABLE */
    .data-table { width: 100%; border-collapse: collapse; font-size: 12px; }
    .data-table thead tr { background: #f8fafc; border-bottom: 2px solid #e2e8f0; }
    .data-table thead th {
        padding: 12px 16px;
        font-size: 9px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94a3b8;
        text-align: left;
    }
    .data-table thead th.right { text-align: right; }
    .data-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: background 0.15s; }
    .data-table tbody tr:hover { background: #f0fdff; }
    .data-table tbody td { padding: 12px 16px; color: #374151; vertical-align: middle; }
    .data-table tbody td.date-cell { font-weight: 600; color: #64748b; white-space: nowrap; font-size: 11px; }
    .data-table tbody td.desc-cell { font-weight: 500; color: #1e293b; }
    .data-table tbody td.amount-cell { text-align: right; font-weight: 800; color: #059669; white-space: nowrap; }
    .data-table tbody td.user-cell { }

    /* Avatar */
    .user-avatar {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .avatar-circle {
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: linear-gradient(135deg, #e0f2fe, #bae6fd);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 9px;
        font-weight: 800;
        color: #0369a1;
        text-transform: uppercase;
    }
    .user-name { font-size: 11px; font-weight: 600; color: #374151; }

    /* Empty state */
    .empty-state {
        padding: 48px 24px;
        text-align: center;
    }
    .empty-state svg { color: #e2e8f0; margin: 0 auto 12px; display: block; }
    .empty-state h4 { font-size: 13px; font-weight: 600; color: #94a3b8; }
    .empty-state p { font-size: 10px; color: #cbd5e1; margin-top: 4px; }

    /* Pagination wrapper */
    .pagination-wrap { padding: 14px 16px; border-top: 1px solid #f1f5f9; background: #f8fafc; }

    /* ===== FILTER CARD ===== */
    .filter-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 18px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.05);
    }
    .filter-form {
        display: flex;
        align-items: flex-end;
        gap: 14px;
        flex-wrap: wrap;
    }
    .filter-field { flex: 1; min-width: 140px; }
    .btn-filter {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        background: linear-gradient(135deg, #06b6d4, #2563eb);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: opacity 0.2s;
        white-space: nowrap;
    }
    .btn-filter:hover { opacity: 0.9; }
    .btn-reset {
        display: inline-flex;
        align-items: center;
        padding: 9px 14px;
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 700;
        text-decoration: none;
        font-family: inherit;
        white-space: nowrap;
        transition: background 0.2s;
    }
    .btn-reset:hover { background: #e2e8f0; }
</style>
@endpush

@section('content')

{{-- Flash --}}
@if(session('success'))
    <div class="flash-success">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#059669" style="width:18px;height:18px;flex-shrink:0">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        <span>{{ session('success') }}</span>
    </div>
@endif

<div class="esteguk-grid">

    {{-- ============ LEFT: FORM ============ --}}
    <div class="form-card">
        <div class="form-card-header">
            <div class="form-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="white" style="width:18px;height:18px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
            </div>
            <div>
                <h3>Catat Pemasukan Baru</h3>
                <p>Tambahkan data pendapatan Es Teguk</p>
            </div>
        </div>

        <form action="{{ route('keuangan.es_teguk.store') }}" method="POST">
            @csrf

            <div class="form-field">
                <label class="form-label">Tanggal Pemasukan</label>
                <input type="date" name="income_date" value="{{ date('Y-m-d') }}" required class="form-input">
            </div>

            <div class="form-field">
                <label class="form-label">Nominal Pemasukan</label>
                <div class="input-group">
                    <span class="input-prefix">Rp</span>
                    <input type="number" name="amount" required min="1"
                           class="form-input-rp"
                           placeholder="Contoh: 350000">
                </div>
            </div>

            <div class="form-field">
                <label class="form-label">Keterangan / Deskripsi</label>
                <textarea name="description" rows="4" class="form-textarea"
                          placeholder="Tulis keterangan detail pemasukan (misal: Penjualan Harian Es Teguk Rasa Mangga)..."></textarea>
            </div>

            <button type="submit" class="btn-save">💾 &nbsp;Simpan Pemasukan</button>
        </form>
    </div>

    {{-- ============ RIGHT: STATS + TABLE ============ --}}
    <div class="right-col">

        <div class="banner">
            <div class="banner-text">
                <div class="banner-label">Pemasukan Es Teguk — Periode {{ $startDate->translatedFormat('d M Y') }} s/d {{ $endDate->translatedFormat('d M Y') }}</div>
                <div class="banner-amount">Rp {{ number_format($totalIncomeThisMonth, 0, ',', '.') }}</div>
                <div class="banner-sub">Total kumulatif pendapatan bisnis Es Teguk pada periode terpilih</div>
            </div>
            <div class="banner-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#67e8f9" style="width:34px;height:34px">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/>
                </svg>
            </div>
        </div>

        {{-- FILTER CARD --}}
        <div class="filter-card">
            <form action="{{ route('keuangan.es_teguk') }}" method="GET" class="filter-form">
                <div class="filter-field">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="form-input">
                </div>
                <div class="filter-field">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="form-input">
                </div>
                <div class="filter-field" style="display:flex;align-items:flex-end;gap:8px;">
                    <button type="submit" class="btn-filter">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" style="width:13px;height:13px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 0 1-.659 1.591l-5.432 5.432a2.25 2.25 0 0 0-.659 1.591v2.927a2.25 2.25 0 0 1-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 0 0-.659-1.591L3.659 7.409A2.25 2.25 0 0 1 3 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0 1 12 3Z"/>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('keuangan.es_teguk') }}" class="btn-reset">Reset</a>
                </div>
            </form>
        </div>

        {{-- TABLE CARD --}}
        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">
                    <div class="table-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#0284c7" style="width:16px;height:16px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/>
                        </svg>
                    </div>
                    <h3>Riwayat Pemasukan Es Teguk</h3>
                </div>
                <div class="btn-group">
                    <button class="btn-cetak" onclick="exportPreview()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" style="width:12px;height:12px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 1.258a1.791 1.791 0 0 1-1.764 2.117H7.874a1.791 1.791 0 0 1-1.764-2.117L6.34 18m11.32 0h-11.32M9 10.5h.008v.008H9V10.5Zm6 0h.008v.008H15V10.5Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0-1.105-.895-2-2-2h-11c-1.105 0-2 .895-2 2M19.5 10.5a2.25 2.25 0 0 1 2.25 2.25v5.625a1.5 1.5 0 0 1-1.5 1.5h-1.5M19.5 10.5v3.75m-15-3.75a2.25 2.25 0 0 0-2.25 2.25v5.625a1.5 1.5 0 0 0 1.5 1.5h1.5M4.5 10.5v3.75m11.25-3.75h-7.5V3c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v6.75Z"/>
                        </svg>
                        Cetak / Preview
                    </button>
                    <button class="btn-excel-sm" onclick="exportExcel()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="white" style="width:12px;height:12px">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>
                        </svg>
                        Excel
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div style="overflow-x:auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th style="width:40px;text-align:center;">No.</th>
                            <th>Tanggal</th>
                            <th>Keterangan / Deskripsi</th>
                            <th class="right">Nominal</th>
                            <th>Petugas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($incomes as $inc)
                            <tr>
                                <td style="text-align:center;color:#94a3b8;">{{ $loop->iteration + (($incomes->currentPage() - 1) * $incomes->perPage()) }}</td>
                                <td class="date-cell">{{ \Carbon\Carbon::parse($inc->income_date)->format('d/m/Y') }}</td>
                                <td class="desc-cell">{{ $inc->description ?: '-' }}</td>
                                <td class="amount-cell">Rp {{ number_format($inc->amount, 0, ',', '.') }}</td>
                                <td class="user-cell">
                                    <div class="user-avatar">
                                        <div class="avatar-circle">{{ substr($inc->user->name, 0, 2) }}</div>
                                        <span class="user-name">{{ $inc->user->name }}</span>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" style="width:44px;height:44px">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 2.625c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125"/>
                                        </svg>
                                        <h4>Belum ada data pemasukan Es Teguk untuk periode ini</h4>
                                        <p>Ubah filter tanggal atau tambahkan pemasukan baru</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($incomes->hasPages())
                <div class="pagination-wrap">
                    {{ $incomes->appends(request()->query())->links() }}
                </div>
            @endif
        </div>

    </div>
</div>

<script>
    function getFilterParams() {
        var sd = document.querySelector('input[name="start_date"]').value;
        var ed = document.querySelector('input[name="end_date"]').value;
        var params = '';
        if (sd) params += '&start_date=' + sd;
        if (ed) params += '&end_date=' + ed;
        return params;
    }
    function exportPreview() {
        window.open('{{ route('keuangan.es_teguk') }}?export=preview' + getFilterParams(), '_blank');
    }
    function exportExcel() {
        window.open('{{ route('keuangan.es_teguk') }}?export=excel' + getFilterParams(), '_blank');
    }
</script>
@endsection
