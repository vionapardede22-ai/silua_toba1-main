@extends('layouts.admin')
@section('page_title', 'Kelola Info Profil')

@section('content')
<div class="max-w-5xl">
    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-xl flex items-center gap-3">
            <i data-lucide="check-circle" class="text-green-500 w-5 h-5"></i>
            <p class="text-sm text-green-700 font-bold">{{ session('success') }}</p>
        </div>
    @endif

    <div class="admin-card border-t-8 border-orange-brand">
        <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-8">
            @csrf 
            @method('PUT')

            <!-- ✅ TAMBAHKAN KOLOM INI (SOLUSI ERROR hero_title) -->
            <div class="admin-input-group">
                <label>Judul Utama Halaman Profil (Hero Title)</label>
                <input type="text" name="hero_title" value="{{ old('hero_title', $profile->hero_title) }}" 
                       class="silua-input-v2" required placeholder="Contoh: Profil Perusahaan Silua Toba">
                <p class="text-[10px] text-gray-400 mt-1">*Muncul sebagai tulisan besar di bagian atas halaman profil user.</p>
            </div>

            <div class="admin-input-group">
                <label>Sejarah / Tentang Silua Toba</label>
                <textarea name="history_text" rows="6" class="silua-input-v2" required 
                          placeholder="Ceritakan awal mula Silua Toba berdiri...">{{ old('history_text', $profile->history_text) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="admin-input-group">
                    <label>Visi usaha</label>
                    <textarea name="vision" rows="4" class="silua-input-v2" required 
                              placeholder="Mimpi besar perusahaan...">{{ old('vision', $profile->vision) }}</textarea>
                </div>
                <div class="admin-input-group">
                    <label>Misi usaha</label>
                    <textarea name="mission" rows="4" class="silua-input-v2" required 
                              placeholder="Langkah-langkah untuk mencapai visi...">{{ old('mission', $profile->mission) }}</textarea>
                </div>
            </div>

            <div class="admin-input-group">
                <label>Link Embed Google Maps</label>
                <input type="text" name="map_embed" value="{{ old('map_embed', $profile->map_embed) }}" 
                       class="silua-input-v2" required placeholder="Paste link 'src' dari Google Maps Embed">
                <p class="text-[10px] text-gray-400 mt-1">*Ambil dari: Google Maps > Share > Embed Map > Ambil URL di dalam atribut src="..."</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="btn-admin-submit-v2 w-full shadow-lg">
                    <i data-lucide="save" class="w-5 h-5 mr-2"></i>
                    SIMPAN PERUBAHAN PROFIL
                </button>
            </div>
        </form>
    </div>
</div>
@endsection