@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page_title', 'Ubah Data Produk')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="flex items-center gap-5 mb-8">
        <a href="{{ route('admin.produk.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-navy-dark shadow-sm hover:bg-orange-brand hover:text-white transition-all">
            <i data-lucide="chevron-left"></i>
        </a>
        <h3 class="text-2xl font-black text-navy-dark uppercase">Edit Produk: {{ $product->name }}</h3>
    </div>

    <div class="admin-card border-t-[10px] border-orange-brand shadow-2xl">
        <form action="{{ route('admin.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf
            @method('PUT') <!-- WAJIB untuk proses Update di Laravel -->

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="admin-input-group">
                    <label class="form-label-custom">Nama Produk</label>
                    <input type="text" name="name" value="{{ $product->name }}" required class="silua-input-v2">
                </div>

                <div class="admin-input-group">
                    <label class="form-label-custom">Kategori</label>
                    <select name="category" class="silua-input-v2">
                        <option value="Snack" {{ $product->category == 'Snack' ? 'selected' : '' }}>Snack / Cemilan</option>
                        <option value="Makanan Berat" {{ $product->category == 'Makanan Berat' ? 'selected' : '' }}>Makanan Berat</option>
                        <option value="Minuman" {{ $product->category == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                    </select>
                </div>

                <div class="admin-input-group">
                    <label class="form-label-custom">Harga Jual (Rp)</label>
                    <input type="number" name="price" value="{{ $product->price }}" required class="silua-input-v2">
                </div>

                <div class="admin-input-group">
                    <label class="form-label-custom">Foto Produk (Biarkan kosong jika tidak diganti)</label>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('uploads/products/'.$product->image) }}" class="w-16 h-16 rounded-xl object-cover border">
                        <input type="file" name="image" class="silua-input-v2 file-input">
                    </div>
                </div>
            </div>

            <div class="admin-input-group">
                <label class="form-label-custom">Deskripsi</label>
                <textarea name="description" rows="5" class="silua-input-v2">{{ $product->description }}</textarea>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t">
                <button type="submit" class="btn-admin-submit-v2">
                    <i data-lucide="refresh-cw"></i> SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </div>
</div>
@endsection