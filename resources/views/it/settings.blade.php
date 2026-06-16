@extends('layouts.app')

@section('title', 'Pengaturan Toko')
@section('page_title', 'Pengaturan Profil Toko & Struk')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wide">Pengaturan Profil & Sistem</h3>
        </div>

        <form action="{{ route('it.settings.save') }}" method="POST" class="p-6 space-y-6 text-xs font-semibold text-slate-500">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Left Panel: Shop Identity -->
                <div class="space-y-4">
                    <h4 class="font-extrabold text-[10px] text-indigo-600 uppercase tracking-widest border-b border-slate-100 pb-1.5">Identitas Toko</h4>
                    
                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Nama Toko Utama</label>
                        <input type="text" name="shop_name" value="{{ $settings['shop_name'] }}" required
                               class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-bold text-sm">
                    </div>

                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Sub-Header Toko</label>
                        <input type="text" name="shop_subtitle" value="{{ $settings['shop_subtitle'] }}" required
                               class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs">
                    </div>

                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Alamat Lengkap Toko</label>
                        <textarea name="shop_address" rows="3" required
                                  class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs leading-normal">{{ $settings['shop_address'] }}</textarea>
                    </div>

                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Nomor Telepon / WA Toko</label>
                        <input type="text" name="shop_phone" value="{{ $settings['shop_phone'] }}" required
                               class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs">
                    </div>
                </div>

                <!-- Right Panel: Receipt Printer settings -->
                <div class="space-y-4">
                    <h4 class="font-extrabold text-[10px] text-indigo-600 uppercase tracking-widest border-b border-slate-100 pb-1.5">Konfigurasi Struk Kertas 58mm</h4>
                    
                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Pesan Footer Struk Belanja</label>
                        <textarea name="shop_receipt_footer" rows="5" required
                                  class="w-full p-2.5 bg-slate-50 border border-slate-200/90 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-xs font-mono leading-relaxed"
                                  placeholder="Ucapan terima kasih atau ketentuan pengembalian barang...">{{ $settings['shop_receipt_footer'] }}</textarea>
                    </div>

                    <div>
                        <label class="block text-slate-500 mb-1.5 uppercase">Kapasitas Karakter Lebar Printer (58mm)</label>
                        <select name="printer_chars_per_line" class="w-full p-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 font-bold text-sm">
                            <option value="32" {{ $settings['printer_chars_per_line'] == '32' ? 'selected' : '' }}>32 Karakter per baris (Standar)</option>
                            <option value="38" {{ $settings['printer_chars_per_line'] == '38' ? 'selected' : '' }}>38 Karakter per baris (Font Kecil)</option>
                        </select>
                    </div>

                    <div class="bg-indigo-50/50 border border-indigo-100 rounded-xl p-4 space-y-2 text-[10px] text-slate-500 leading-normal">
                        <span class="font-bold text-indigo-800 block uppercase tracking-wider">Info Tambahan</span>
                        <p>Pilih jumlah karakter yang sesuai dengan printer Anda agar tulisan di struk tidak terpotong ke baris baru secara tidak wajar.</p>
                    </div>
                </div>

            </div>

            <!-- Submit buttons -->
            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit"
                        class="py-3 px-6 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-md transition-all active:scale-95 cursor-pointer text-center">
                    Simpan Pengaturan
                </button>
            </div>

        </form>
    </div>
</div>
@endsection
