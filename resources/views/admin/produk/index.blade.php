@extends('layouts.admin')

@section('title', 'Daftar Produk')
@section('page_title', 'Kelola Produk')

@section('content')

<!-- HEADER -->
<div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
    <div>
        <h3 class="text-3xl font-black text-navy-dark tracking-tighter uppercase">
            Daftar Produk
        </h3>
        <p class="text-gray-500 text-sm font-medium">
            Total terdapat {{ $products->count() }} produk di dapur.
        </p>
    </div>

    <a href="{{ route('admin.produk.create') }}" class="btn-admin-primary">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        <span>Tambah Produk Baru</span>
    </a>
</div>

<!-- ALERT -->
@if(session('success'))
<div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-xl flex items-center gap-3 animate-fade-in">
    <i data-lucide="check-circle" class="text-green-500 w-5 h-5"></i>
    <p class="text-sm text-green-700 font-bold">
        {{ session('success') }}
    </p>
</div>
@endif

<!-- TABLE -->
<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            
            <!-- HEADER -->
            <thead>
                <tr>
                    <th class="text-center">Gambar</th>
                    <th>Detail Produk</th>
                    <th>Kategori</th>
                    <th>Harga Jual</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @forelse($products as $p)
                <tr>
                    
                    <!-- GAMBAR -->
                    <td class="text-center w-32">
                        <div class="inline-block group">
                            <img 
                                src="{{ asset('uploads/products/'.$p->image) }}" 
                                alt="{{ $p->name }}"
                                class="product-img-thumb shadow-md transition-transform duration-300 group-hover:scale-110"
                            >
                        </div>
                    </td>

                    <!-- DETAIL -->
                    <td>
                        <div class="product-name-title">
                            {{ $p->name }}
                        </div>
                        <div class="product-id-tag">
                            #PROD-{{ str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                        </div>
                    </td>

                    <!-- KATEGORI -->
                    <td>
                        <span class="badge-pill-category">
                            {{ $p->category }}
                        </span>
                    </td>

                    <!-- HARGA -->
                    <td>
                        <div class="price-text">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </div>
                    </td>

                    <!-- AKSI -->
                    <td>
                        <div class="flex justify-center gap-3">
                            
                            <!-- EDIT -->
                            <a 
                                href="{{ route('admin.produk.edit', $p->id) }}" 
                                class="action-btn-pill edit"
                            >
                                <i data-lucide="edit-3"></i>
                                <span>Edit</span>
                            </a>

                            <!-- DELETE -->
                            <form 
                                action="{{ route('admin.produk.destroy', $p->id) }}" 
                                method="POST" 
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn-pill delete">
                                    <i data-lucide="trash-2"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <!-- EMPTY STATE -->
                <tr>
                    <td colspan="5" class="py-20 text-center">
                        <div class="opacity-30 mb-4">
                            <i data-lucide="package-search" class="w-16 h-16 mx-auto"></i>
                        </div>
                        <p class="text-gray-400 font-semibold uppercase text-xs tracking-widest">
                            Belum ada produk, silakan tambahkan data baru
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection