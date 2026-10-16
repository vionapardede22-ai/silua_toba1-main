@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page_title', 'Input Data Produk')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Header Page -->
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-5">
            <a href="{{ route('admin.produk.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-navy-dark shadow-sm hover:bg-orange-brand hover:text-white hover:rotate-[-10deg] transition-all duration-300">
                <i data-lucide="chevron-left" class="w-6 h-6"></i>
            </a>
            <div>
                <h3 class="text-2xl font-black text-navy-dark tracking-tight uppercase">Tambah Produk Baru</h3>
                <p class="text-gray-400 text-sm font-medium">Lengkapi detail produk Silua Toba Anda.</p>
            </div>
        </div>
    </div>

    <!-- Main Card Form -->
    <div class="admin-card border-t-[10px] border-orange-brand shadow-2xl relative overflow-hidden">
        <!-- Dekorasi Background Halus -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-brand/5 rounded-full -mr-16 -mt-16"></div>

        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8 relative z-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                <!-- Nama Produk -->
                <div class="admin-input-group">
                    <label class="form-label-custom">Nama Produk</label>
                    <div class="relative">
                        <i data-lucide="type" class="input-icon-left"></i>
                        <input type="text" name="name" required class="silua-input-v2" placeholder="Misal: Mie Gomak Kuah Pedas">
                    </div>
                </div>

                <!-- Kategori -->
                <div class="admin-input-group">
                    <label class="form-label-custom">Kategori Produk</label>
                    <div class="relative">
                        <i data-lucide="tag" class="input-icon-left"></i>
                        <select name="category" class="silua-input-v2 appearance-none">
                            <option value="Snack">Snack / Cemilan</option>
                            <option value="Makanan Berat">Makanan Berat</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Harga -->
                <div class="admin-input-group">
                    <label class="form-label-custom">Harga Jual (Rp)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 font-bold text-navy-dark border-r border-gray-200 pr-3">Rp</span>
                        <input type="number" name="price" required class="silua-input-v2 !pl-16" placeholder="75.000">
                    </div>
                </div>

                <!-- Gambar -->
                <div class="admin-input-group">
                    <label class="form-label-custom">Foto Produk</label>
                    <div class="relative group">
                        <input type="file" name="image" id="image" required class="hidden-file-input" onchange="updateFileName(this)">
                        <label for="image" class="file-upload-wrapper">
                            <i data-lucide="image" class="w-5 h-5 text-orange-brand"></i>
                            <span id="file-chosen" class="text-gray-400 font-medium">Pilih foto produk...</span>
                            <span class="bg-navy-dark text-white px-3 py-1 rounded-lg text-[10px] ml-auto uppercase font-bold">Browse</span>
                        </label>
                    </div>
                    <p class="text-[10px] text-gray-400 mt-2 ml-2 italic">*Rekomendasi: Ukuran 1:1 (Square) maks 2MB</p>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="admin-input-group">
                <label class="form-label-custom">Deskripsi Singkat</label>
                <textarea name="description" rows="5" class="silua-input-v2 !py-4" placeholder="Ceritakan keistimewaan rasa, bumbu, atau sejarah produk ini agar pembeli tertarik..."></textarea>
            </div>

            <!-- Footer Buttons -->
            <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100">
                <button type="reset" class="px-8 py-4 text-gray-400 font-bold hover:text-red-500 transition-all uppercase text-xs tracking-widest">
                    Reset Form
                </button>
                <button type="submit" class="btn-admin-submit-v2 shadow-orange-brand/20 shadow-2xl">
                    <i data-lucide="save" class="w-5 h-5"></i>
                    <span>UPLOAD</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileName = input.files[0].name;
        document.getElementById('file-chosen').textContent = fileName;
        document.getElementById('file-chosen').classList.add('text-navy-dark');
    }
</script>
@endsection