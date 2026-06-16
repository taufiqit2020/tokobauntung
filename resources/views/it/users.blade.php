@extends('layouts.app')

@section('title', 'Manajemen Pengguna')
@section('page_title', 'Pengelola Akun Kasir & Karyawan')

@section('content')
<div class="space-y-6">

    <!-- Action Header -->
    <div class="bg-white border border-slate-200 rounded-2xl p-4 shadow-sm flex justify-between items-center">
        <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wide">Daftar Akun Pengguna</h3>
        <button onclick="openAddUserModal()"
                class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-600/10 flex items-center justify-center space-x-1.5 cursor-pointer transition-all active:scale-95">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tambah User Baru</span>
        </button>
    </div>

    <!-- Users Table -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-400 font-bold uppercase tracking-wider">
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Username</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Hak Akses (Role)</th>
                        <th class="p-4 text-center">Status</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-700">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50/50 transition-all">
                            <td class="p-4 font-bold text-slate-900">{{ $user->name }}</td>
                            <td class="p-4 font-semibold text-indigo-600">{{ $user->username }}</td>
                            <td class="p-4 text-slate-500">{{ $user->email ?? '-' }}</td>
                            <td class="p-4 uppercase text-slate-500 font-semibold tracking-wide">{{ str_replace('_', ' ', $user->role) }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $user->is_active ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-slate-100 text-slate-500 border border-slate-200' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <!-- Edit Button -->
                                    <button onclick="openEditUserModal({{ json_encode($user) }})"
                                            class="p-1.5 bg-slate-50 border border-slate-200 hover:border-indigo-500 hover:text-indigo-600 rounded-lg text-slate-600 cursor-pointer transition-all"
                                            title="Ubah User">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.83 18.291a8.9 8.9 0 0 1-3.476 2.087l-1.025.311c-.07.021-.14-.021-.118-.09l.311-1.025a8.9 8.9 0 0 1 2.087-3.476L16.862 4.487ZM16.862 4.487 19.5 7.125" />
                                        </svg>
                                    </button>

                                    <!-- Toggle Activation Button -->
                                    @if($user->id !== Auth::id())
                                        <form action="{{ route('it.users.toggle', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                    class="py-1 px-2.5 border rounded-lg text-[10px] font-bold uppercase cursor-pointer transition-all active:scale-95 {{ $user->is_active ? 'bg-rose-50 border-rose-200 text-rose-600 hover:bg-rose-100' : 'bg-emerald-50 border-emerald-200 text-emerald-600 hover:bg-emerald-100' }}">
                                                {{ $user->is_active ? 'Matikan' : 'Aktifkan' }}
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] text-slate-400 font-semibold italic">Akun Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL: Add User -->
<div id="add-user-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-md w-full shadow-2xl">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-xs uppercase">Tambah User Baru</h3>
            <button onclick="closeAddUserModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form action="{{ route('it.users.store') }}" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nama Lengkap</label>
                <input type="text" name="name" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Nama asli karyawan...">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Username (Untuk Login)</label>
                <input type="text" name="username" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 lowercase"
                       placeholder="Contoh: jumiati">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Alamat Email (Opsional)</label>
                <input type="email" name="email"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Contoh: jumiati@gmail.com">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Hak Akses (Role)</label>
                <select name="role" required
                        class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <option value="">-- Pilih Peran Akses --</option>
                    <option value="admin_kasir">ADMIN KASIR (POS)</option>
                    <option value="keuangan">ADMINISTRASI KEUANGAN</option>
                    <option value="admin_it">ADMIN IT (SYSTEM MANAGER)</option>
                </select>
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Kata Sandi (Password)</label>
                <input type="password" name="password" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Minimal 6 karakter...">
            </div>

            <div class="flex space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeAddUserModal()"
                        class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all active:scale-95 shadow-md cursor-pointer text-center">
                    Buat User
                </button>
            </div>
        </form>
    </div>
</div>

<!-- MODAL: Edit User -->
<div id="edit-user-modal" class="fixed inset-0 bg-slate-950/80 justify-center items-center z-50 p-4 hidden">
    <div class="bg-white border border-slate-200 rounded-2xl p-6 max-w-md w-full shadow-2xl">
        <div class="flex justify-between items-center mb-4 pb-2 border-b border-slate-100">
            <h3 class="font-bold text-slate-800 text-xs uppercase">Ubah User / Karyawan</h3>
            <button onclick="closeEditUserModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <form id="edit-user-form" action="" method="POST" class="space-y-4 text-xs">
            @csrf
            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Nama Lengkap</label>
                <input type="text" name="name" id="edit-name" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Username (Untuk Login)</label>
                <input type="text" name="username" id="edit-username" required
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 lowercase">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Alamat Email (Opsional)</label>
                <input type="email" name="email" id="edit-email"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Hak Akses (Role)</label>
                <select name="role" id="edit-role" required
                        class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                    <option value="admin_kasir">ADMIN KASIR (POS)</option>
                    <option value="keuangan">ADMINISTRASI KEUANGAN</option>
                    <option value="admin_it">ADMIN IT (SYSTEM MANAGER)</option>
                </select>
            </div>

            <div>
                <label class="block text-slate-500 font-bold mb-1.5 uppercase">Kata Sandi Baru (Kosongkan jika tidak diganti)</label>
                <input type="password" name="password"
                       class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Isi jika ingin meriset password user...">
            </div>

            <div class="flex space-x-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeEditUserModal()"
                        class="flex-1 py-2.5 px-4 bg-slate-100 hover:bg-slate-200 text-slate-600 font-bold rounded-xl transition-all cursor-pointer text-center">
                    Batal
                </button>
                <button type="submit"
                        class="flex-1 py-2.5 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all active:scale-95 shadow-md cursor-pointer text-center">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAddUserModal() {
        document.getElementById('add-user-modal').style.display = 'flex';
    }
    function closeAddUserModal() {
        document.getElementById('add-user-modal').style.display = 'none';
    }

    function openEditUserModal(user) {
        const form = document.getElementById('edit-user-form');
        form.action = `/it/users/${user.id}/update`;

        document.getElementById('edit-name').value = user.name;
        document.getElementById('edit-username').value = user.username;
        document.getElementById('edit-email').value = user.email || '';
        document.getElementById('edit-role').value = user.role;

        document.getElementById('edit-user-modal').style.display = 'flex';
    }
    function closeEditUserModal() {
        document.getElementById('edit-user-modal').style.display = 'none';
    }
</script>
@endsection
