@extends('layouts.app')

@section('title', 'Manajemen Produk & Stok')
@section('page_title', 'Katalog Barang & Inventaris')

@section('content')
<div class="space-y-6">

    <!-- Top Action bar & Filters -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Search and filters -->
        <form action="{{ route('keuangan.products') }}" method="GET" class="flex-1 grid grid-cols-1 sm:grid-cols-3 gap-3">
            <!-- Search Text -->
            <div class="relative">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="w-full pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800"
                       placeholder="Cari Kode Barang / nama...">
                <span class="absolute left-3 top-2.5 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                    </svg>
                </span>
            </div>

            <!-- Category Filter -->
            <select name="category_id" onchange="this.form.submit()"
                    class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-800">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ strtoupper($cat->name) }}
                    </option>
                @endforeach
            </select>

            <!-- Buttons -->
            <div class="flex space-x-2">
                <button type="submit" class="flex-1 py-2 px-4 bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold rounded-xl shadow transition-all cursor-pointer">
                    Cari
                </button>
                @if(request('search') || request('category_id') || request('filter'))
                    <a href="{{ route('keuangan.products') }}" class="py-2 px-3 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </div>
        </form>

        <!-- Buttons Group -->
        <div class="flex items-center gap-2">
            <!-- Export Button -->
            <a href="{{ route('keuangan.products.export') }}"
               class="py-2.5 px-3.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-600/10 flex items-center justify-center space-x-1.5 cursor-pointer transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z" />
                </svg>
                <span>Ekspor</span>
            </a>

            <!-- Import Button -->
            <button onclick="openImportModal()"
                    class="py-2.5 px-3.5 bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold rounded-xl shadow-md shadow-amber-600/10 flex items-center justify-center space-x-1.5 cursor-pointer transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                </svg>
                <span>Impor</span>
            </button>

            <!-- Add Product Button -->
            <button onclick="openAddProductModal()"
                    class="py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-600/10 flex items-center justify-center space-x-1.5 cursor-pointer transition-all active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>Tambah Barang</span>
            </button>
        </div>
    </div>

    <!-- Products Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4">Kode Barang</th>
                        <th class="p-4">Nama Produk</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Satuan</th>
                        <th class="p-4 text-right">Harga Modal</th>
                        <th class="p-4 text-right">Harga Jual</th>
                        <th class="p-4 text-right">Harga Grosir</th>
                        <th class="p-4 text-right">Stok</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @forelse($products as $prod)
                        @php
                            $isLowStock = $prod->stock <= $prod->min_stock;
                        @endphp
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 font-bold text-indigo-600 uppercase tracking-wide">{{ $prod->product_code }}</td>
                            <td class="p-4">
                                <span class="font-bold text-slate-900 text-sm block">{{ $prod->name }}</span>
                                 @if($isLowStock)
                                    <span class="text-[9px] font-bold text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded border border-amber-100 uppercase tracking-wide">
                                        Stok Tipis (Min: {{ number_format($prod->min_stock, 0, ',', '.') }})
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 uppercase font-semibold text-slate-500">{{ $prod->category->name }}</td>
                            <td class="p-4">{{ $prod->unit }}</td>
                            <td class="p-4 text-right font-medium text-slate-500">Rp {{ number_format($prod->buy_price, 0, ',', '.') }}</td>
                            <td class="p-4 text-right font-bold text-slate-800">Rp {{ number_format($prod->sell_price, 0, ',', '.') }}</td>
                            <td class="p-4 text-right">
                                @if($prod->wholesale_price)
                                    <span class="font-bold text-emerald-600">Rp {{ number_format($prod->wholesale_price, 0, ',', '.') }}</span>
                                    <span class="text-[9px] text-slate-400 block">Min. beli {{ number_format($prod->wholesale_min_qty, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-slate-400">-</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <span class="font-extrabold text-sm {{ $isLowStock ? 'text-rose-600' : 'text-slate-800' }}">
                                    {{ number_format($prod->stock, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded-full {{ $prod->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    {{ $prod->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Edit Trigger Button -->
                                    <button onclick="openEditProductModal({{ json_encode($prod) }})"
                                            class="p-1.5 bg-slate-50 border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 rounded-lg text-slate-600 cursor-pointer transition-all"
                                            title="Ubah Produk">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 18.291a8.9 8.9 0 0 1-3.476 2.087l-1.025.311c-.07.021-.14-.021-.118-.09l.311-1.025a8.9 8.9 0 0 1 2.087-3.476L16.862 4.487ZM16.862 4.487 19.5 7.125" />
                                        </svg>
                                    </button>

                                    <!-- Delete Form -->
                                    <form action="{{ route('keuangan.products.delete', $prod->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? jika produk memiliki histori transaksi, statusnya hanya akan diganti menjadi NONAKTIF.')">
                                        @csrf
                                        <button type="submit" class="p-1.5 bg-slate-50 border border-slate-200 hover:border-rose-500 hover:text-rose-600 rounded-lg text-slate-600 cursor-pointer transition-all" title="Hapus Produk">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="p-8 text-center text-slate-400 font-medium">Belum ada barang di dalam katalog produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination links -->
        @if($products->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

<!-- MODAL: Add Product -->
<div id="add-product-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-lg w-full shadow-2xl overflow-y-auto max-h-[90%] no-scrollbar">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-sm uppercase">Tambah Produk Baru</h3>
            <button onclick="closeAddProductModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('keuangan.products.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KODE BARANG (Product Code)</label>
                    <input type="text" name="product_code" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase font-bold"
                           placeholder="Contoh: PL-001">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">NAMA PRODUK</label>
                    <input type="text" name="name" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Nama barang lengkap...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KATEGORI</label>
                    <select name="category_id" required
                            class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ strtoupper($cat->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">SATUAN (Unit)</label>
                    <input type="text" name="unit" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Contoh: pcs, pack, kg, dus">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA MODAL (Cost / COGS)</label>
                    <input type="number" name="buy_price" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Harga beli awal...">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA JUAL ECERAN</label>
                    <input type="number" name="sell_price" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Harga eceran umum...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA GROSIR (Opsional)</label>
                    <input type="number" name="wholesale_price" min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Kosongkan jika tidak ada...">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KUANTITAS MINIMUM GROSIR</label>
                    <input type="number" name="wholesale_min_qty" min="1"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Pembelian minimum grosir...">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">STOK AWAL FISIK</label>
                    <input type="number" name="stock" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                           placeholder="Kuantitas stok awal di gudang...">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">STOK MINIMUM ALARM</label>
                    <input type="number" name="min_stock" value="5" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="flex space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddProductModal()"
                        class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all active:scale-95 shadow-md cursor-pointer text-center">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Edit Product -->
<div id="edit-product-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-lg w-full shadow-2xl overflow-y-auto max-h-[90%] no-scrollbar">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-sm uppercase">Ubah Produk</h3>
            <button onclick="closeEditProductModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-product-form" action="" method="POST" class="space-y-4 text-xs">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KODE BARANG (Product Code)</label>
                    <input type="text" name="product_code" id="edit-product-code" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 uppercase font-bold">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">NAMA PRODUK</label>
                    <input type="text" name="name" id="edit-name" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KATEGORI</label>
                    <select name="category_id" id="edit-category" required
                            class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ strtoupper($cat->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">SATUAN (Unit)</label>
                    <input type="text" name="unit" id="edit-unit" required
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA MODAL (Cost / COGS)</label>
                    <input type="number" name="buy_price" id="edit-buy-price" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA JUAL ECERAN</label>
                    <input type="number" name="sell_price" id="edit-sell-price" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">HARGA GROSIR (Opsional)</label>
                    <input type="number" name="wholesale_price" id="edit-wholesale-price" min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">KUANTITAS MINIMUM GROSIR</label>
                    <input type="number" name="wholesale_min_qty" id="edit-wholesale-min-qty" min="1"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">JUMLAH STOK</label>
                    <input type="number" name="stock" id="edit-stock" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">STOK MINIMUM ALARM</label>
                    <input type="number" name="min_stock" id="edit-min-stock" required min="0"
                           class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-slate-500 font-bold mb-1.5">STATUS BARANG</label>
                    <select name="is_active" id="edit-is-active" required
                            class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="1">AKTIF (DIJUAL)</option>
                        <option value="0">NONAKTIF (DITANGGUHKAN)</option>
                    </select>
                </div>
            </div>

            <div class="flex space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditProductModal()"
                        class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all active:scale-95 shadow-md cursor-pointer text-center">
                    Perbarui Produk
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Import Products -->
<div id="import-product-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-md w-full shadow-2xl overflow-y-auto max-h-[90%] no-scrollbar">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-sm uppercase">Impor Produk & Stok</h3>
            <button onclick="closeImportModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('keuangan.products.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5 text-xs">
            @csrf
            
            <div class="bg-amber-50 border border-amber-200 text-amber-800 rounded-xl p-3.5 space-y-2">
                <p class="font-bold">⚠️ Petunjuk Penting Impor:</p>
                <ul class="list-disc pl-5 space-y-1.5 text-[11px] leading-relaxed">
                    <li>Gunakan template CSV resmi yang disediakan di bawah.</li>
                    <li>Sistem mencocokkan barang berdasarkan <strong>KODE BARANG</strong>.</li>
                    <li>Jika kode barang sudah ada, data produk & stok akan <strong>diperbarui (update)</strong>.</li>
                    <li>Jika nama kategori baru diisi, sistem otomatis membuat kategori baru.</li>
                    <li>Simpan Excel Anda dalam format <strong>CSV (Comma Delimited)</strong> sebelum diunggah.</li>
                </ul>
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-2">Pilih File CSV</label>
                <input type="file" name="file" required accept=".csv,.txt"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500">
            </div>

            <div class="flex flex-col gap-2 pt-2 border-t border-slate-100">
                <!-- Download Template Button -->
                <a href="{{ route('keuangan.products.template') }}"
                   class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all cursor-pointer text-center block">
                    📥 Download Template Impor (CSV)
                </a>
                
                <div class="flex space-x-3 mt-2">
                    <button type="button" onclick="closeImportModal()"
                            class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer text-center">
                        Batal
                    </button>
                    <button type="submit"
                            class="flex-1 py-2.5 px-4 bg-amber-600 hover:bg-amber-700 text-white font-bold rounded-xl transition-all active:scale-95 shadow-md cursor-pointer text-center">
                        Mulai Impor
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Add product modals trigger
    function openAddProductModal() {
        document.getElementById('add-product-modal').style.display = 'flex';
    }
    function closeAddProductModal() {
        document.getElementById('add-product-modal').style.display = 'none';
    }

    // Import product modals trigger
    function openImportModal() {
        document.getElementById('import-product-modal').style.display = 'flex';
    }
    function closeImportModal() {
        document.getElementById('import-product-modal').style.display = 'none';
    }

    // Edit product modals trigger
    function openEditProductModal(product) {
        const form = document.getElementById('edit-product-form');
        form.action = `/keuangan/products/${product.id}/update`;

        document.getElementById('edit-product-code').value = product.product_code;
        document.getElementById('edit-name').value = product.name;
        document.getElementById('edit-category').value = product.category_id;
        document.getElementById('edit-unit').value = product.unit;
        document.getElementById('edit-buy-price').value = parseInt(product.buy_price);
        document.getElementById('edit-sell-price').value = parseInt(product.sell_price);
        document.getElementById('edit-wholesale-price').value = product.wholesale_price ? parseInt(product.wholesale_price) : '';
        document.getElementById('edit-wholesale-min-qty').value = product.wholesale_min_qty || '';
        document.getElementById('edit-stock').value = product.stock;
        document.getElementById('edit-min-stock').value = product.min_stock;
        document.getElementById('edit-is-active').value = product.is_active;

        document.getElementById('edit-product-modal').style.display = 'flex';
    }
    
    function closeEditProductModal() {
        document.getElementById('edit-product-modal').style.display = 'none';
    }
</script>
@endsection
