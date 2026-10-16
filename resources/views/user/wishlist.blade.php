@extends('layouts.user')

@section('title', 'Wishlist Saya')

@section('content')
<!-- PENTING: Panggil CSS agar tampilan kartu & modal konsisten -->
<link rel="stylesheet" href="{{ asset('css/produk-user.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal-produk.css') }}">

<section class="pt-40 pb-20 bg-light-bg min-h-screen">
    <div class="max-w-7xl mx-auto px-6 text-center">
        
        <div class="mb-12">
            <p class="text-orange-brand font-black tracking-[0.3em] uppercase text-xs mb-2">Simpanan Favorit</p>
            <h2 class="text-4xl font-black text-navy-dark italic" style="font-family: 'Lora', serif;">Wishlist Saya</h2>
            <div class="h-1 w-20 bg-orange-brand mt-4 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-left">
            @forelse($wishlists as $w)
            <div class="product-premium-card show">
                <div class="product-media relative">
                    <!-- Gambar Produk -->
                    <img src="{{ asset('uploads/products/'.$w->product->image) }}" alt="{{ $w->product->name }}">
                    
                    <!-- Tombol Hapus dari Wishlist (Sampah) -->
                    <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute top-4 right-4 z-20">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $w->product->id }}">
                        <button type="submit" class="wish-btn-v2" style="background: #ef4444; color: white; border: none; cursor: pointer;" title="Hapus dari Favorit">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>

                <div class="product-info-v2">
                    <p class="product-cat-v2">{{ $w->product->category }}</p>
                    <h3 class="product-name-v2">{{ $w->product->name }}</h3>
                    
                    <div class="product-footer-v2 bg-gray-50/50">
                        <div class="text-left">
                            <span class="price-label-v2">Harga</span>
                            <span class="price-value-v2">Rp {{ number_format($w->product->price,0,',','.') }}</span>
                        </div>
                        
                        <!-- FIX: Tombol Buka Modal dengan DATA LENGKAP agar Ulasan Muncul -->
                        <button type="button" class="buy-btn-v2 btn-navy-v2" 
                            onclick="openOrderModal(
                                '{{ $w->product->id }}', 
                                '{{ addslashes($w->product->name) }}', 
                                '{{ $w->product->price }}', 
                                '{{ asset('uploads/products/'.$w->product->image) }}', 
                                '{{ addslashes($w->product->description) }}', 
                                {{ $w->product->reviews->load('user')->toJson() }}
                            )">
                            <i data-lucide="shopping-cart"></i>
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 opacity-30 text-center">
                <i data-lucide="heart-off" class="w-20 h-20 mx-auto mb-4 text-navy-dark"></i>
                <p class="text-xl font-bold uppercase tracking-widest text-navy-dark">Belum ada produk favorit</p>
                <a href="{{ route('user.products') }}" class="btn-tambah-ulasan mt-6 inline-flex">
                    Cari Produk Sekarang
                </a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- PANGGIL KOMPONEN MODAL -->
@include('components.modal-detail-produk')

@endsection