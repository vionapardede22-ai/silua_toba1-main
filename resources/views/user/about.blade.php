@extends('layouts.user')

@section('title', 'Tentang Silua Toba')

@section('content')
<link rel="stylesheet" href="{{ asset('css/about-user.css') }}">

<!-- SECTION 1: HERO (Judul Utama) -->
<section class="about-hero-minimal">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="products-subtitle">Kisah Perjalanan</span>
        <h1 class="about-title-large">Tentang Silua Toba</h1>
        <div class="h-1.5 w-20 bg-orange-brand mx-auto mt-6 rounded-full"></div>
    </div>
</section>

<!-- SECTION 2: CONTENT SECTIONS (ZIG-ZAG STYLE ALA ICHIBAN) -->
@forelse($abouts as $a)
<section class="py-24 {{ $loop->even ? 'bg-light-bg' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Logika flex-row-reverse jika perulangan genap -->
        <div class="flex flex-col {{ $loop->even ? 'md:flex-row-reverse' : 'md:flex-row' }} items-center gap-20">
            
            <!-- Area Gambar dengan Bingkai Putih Tebal -->
            <div class="flex-1 w-full">
                <div class="ichiban-frame shadow-2xl">
                    <img src="{{ asset('uploads/about/' . $a->image) }}" alt="{{ $a->title }}">
                </div>
            </div>

            <!-- Area Teks -->
            <div class="flex-1 w-full text-center md:text-left">
                <h2 class="ichiban-heading">
                    {{ $a->title }} <br>
                    <span class="text-orange-brand">{{ $a->subtitle }}</span>
                </h2>
                <div class="h-1 w-16 bg-navy-dark my-6 mx-auto md:ml-0"></div>
                
                <div class="description-text">
                    {!! nl2br(e($a->description)) !!}
                </div>

                @if($a->years_experience)
                <div class="mt-8 flex items-center justify-center md:justify-start gap-4">
                    <div class="text-4xl font-black text-navy-dark">{{ $a->years_experience }}+</div>
                    <div class="text-[10px] font-bold uppercase tracking-widest text-gray-400 leading-tight">
                        Tahun <br> Konsisten
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@empty
    <p class="text-center py-20 text-gray-400">Belum ada konten About Us.</p>
@endforelse

@endsection