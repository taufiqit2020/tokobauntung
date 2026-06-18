@extends('layouts.app')

@section('title', 'Manajemen Kategori Barang')
@section('page_title', 'Kategori Barang')

@section('content')
<div class="space-y-6">

    <!-- Top Toolbar (Search and Add Buttons) -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
        <!-- Search bar -->
        <form action="{{ route('keuangan.categories') }}" method="GET" class="flex flex-1 max-w-lg items-center space-x-2 m-0">
            <div class="relative flex-1">
                <span class="absolute left-3 top-2.5 text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.637 10.637Z" />
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari nama kategori..."
                       class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-xs font-semibold text-slate-800">
            </div>
            <button type="submit" class="py-2.5 px-4 bg-slate-800 hover:bg-slate-900 text-white font-bold rounded-xl text-xs transition-all active:scale-95 cursor-pointer">
                Cari
            </button>
            @if(request()->filled('search'))
                <a href="{{ route('keuangan.categories') }}" class="py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl text-xs transition-all text-center">
                    Reset
                </a>
            @endif
        </form>

        <!-- Add Category Button -->
        <button onclick="openAddCategoryModal()"
                class="py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl text-xs shadow-md shadow-indigo-600/10 transition-all active:scale-95 cursor-pointer flex items-center space-x-1.5 self-start md:self-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tambah Kategori Baru</span>
        </button>
    </div>

    <!-- Categories Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4 w-12 text-center">No</th>
                        <th class="p-4">Nama Kategori</th>
                        <th class="p-4">Deskripsi / Keterangan</th>
                        <th class="p-4 text-center w-36">Jumlah Produk</th>
                        <th class="p-4 text-center w-28">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                    @forelse($categories as $idx => $cat)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 text-center text-slate-400">{{ $categories->firstItem() + $idx }}</td>
                            <td class="p-4 font-bold text-slate-800 uppercase tracking-wide">{{ $cat->name }}</td>
                            <td class="p-4 text-slate-500 font-normal">{{ $cat->description ?: '-' }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2.5 py-1 bg-slate-100 text-slate-800 text-[10px] font-bold rounded-full border border-slate-200">
                                    {{ $cat->products()->count() }} Produk
                                </span>
                            </td>
                            <td class="p-4 text-center flex items-center justify-center space-x-1">
                                <!-- Edit Button -->
                                <button onclick="openEditCategoryModal({{ json_encode($cat) }})"
                                        class="p-1.5 bg-slate-50 border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 rounded-lg transition-all cursor-pointer"
                                        title="Edit Kategori">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('keuangan.categories.delete', $cat->id) }}" method="POST"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori [{{ $cat->name }}]?')" class="inline m-0">
                                    @csrf
                                    <button type="submit"
                                            class="p-1.5 bg-slate-50 border border-slate-200 text-slate-400 hover:text-rose-600 hover:border-rose-200 rounded-lg transition-all cursor-pointer"
                                            title="Hapus Kategori">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400 font-medium">Data kategori tidak ditemukan atau belum ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($categories->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>

<!-- MODAL: Add Category -->
<div id="add-category-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform transition-all duration-300">
        <!-- Header -->
        <div class="px-6 py-4 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="font-bold text-sm uppercase tracking-wide">Tambah Kategori Baru</h3>
            <button onclick="closeAddCategoryModal()" class="text-slate-400 hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('keuangan.categories.store') }}" method="POST" class="p-6 space-y-4 m-0 text-xs">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nama Kategori</label>
                <input type="text" name="name" required placeholder="Contoh: PLASTIK KLIP, MINUMAN, DUS"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-semibold uppercase">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Deskripsi / Keterangan</label>
                <textarea name="description" rows="3" placeholder="Tulis deskripsi singkat mengenai kategori ini (opsional)..."
                          class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-2 pt-2 border-t border-slate-100">
                <button type="button" onclick="closeAddCategoryModal()"
                        class="py-2 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-600/15 cursor-pointer">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Edit Category -->
<div id="edit-category-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform transition-all duration-300">
        <!-- Header -->
        <div class="px-6 py-4 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="font-bold text-sm uppercase tracking-wide">Edit Kategori Barang</h3>
            <button onclick="closeEditCategoryModal()" class="text-slate-400 hover:text-white cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Form -->
        <form id="edit-category-form" method="POST" class="p-6 space-y-4 m-0 text-xs">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nama Kategori</label>
                <input type="text" name="name" id="edit-name" required placeholder="Contoh: PLASTIK KLIP, MINUMAN, DUS"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-semibold uppercase">
            </div>

            <!-- Description -->
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Deskripsi / Keterangan</label>
                <textarea name="description" id="edit-description" rows="3" placeholder="Tulis deskripsi singkat mengenai kategori ini (opsional)..."
                          class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-medium"></textarea>
            </div>

            <!-- Actions -->
            <div class="flex justify-end space-x-2 pt-2 border-t border-slate-100">
                <button type="button" onclick="closeEditCategoryModal()"
                        class="py-2 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer">
                    Batal
                </button>
                <button type="submit"
                        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-md shadow-indigo-600/15 cursor-pointer">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Add Category Modal
    function openAddCategoryModal() {
        document.getElementById('add-category-modal').style.display = 'flex';
    }
    function closeAddCategoryModal() {
        document.getElementById('add-category-modal').style.display = 'none';
    }

    // Edit Category Modal
    function openEditCategoryModal(category) {
        document.getElementById('edit-name').value = category.name;
        document.getElementById('edit-description').value = category.description || '';
        
        // Update form action dynamically
        const form = document.getElementById('edit-category-form');
        form.action = `/keuangan/categories/${category.id}/update`;

        document.getElementById('edit-category-modal').style.display = 'flex';
    }
    function closeEditCategoryModal() {
        document.getElementById('edit-category-modal').style.display = 'none';
    }
</script>
@endsection
