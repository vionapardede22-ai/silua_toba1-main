@extends('layouts.user')

@section('title', 'Galeri Foto - Silua Toba')

@section('content')
<link rel="stylesheet" href="{{ asset('css/gallery-user.css') }}">

<section class="silua-gallery-section">
    <div class="max-w-7xl mx-auto px-6">
        
        <!-- HEADER KONSEP X3 -->
        <div class="text-center mb-16">
            <h1 class="gallery-main-title">Galeri Dokumentasi</h1>
            <p class="gallery-subtitle">Kumpulan momen aktivitas dan produksi Silua Toba</p>
            <div class="h-0.5 w-20 bg-gray-200 mx-auto mt-6"></div>
        </div>

        <!-- Bagian Grid di dalam gallery.blade.php -->
<div class="gallery-grid">
    @foreach($galleries as $g)
    <div class="gallery-card-container">
        <div class="x3-card group" onclick="openFullImage('{{ asset('uploads/gallery/'.$g->file) }}', '{{ $g->title }}', '{{ $g->description }}')">
            
            <!-- Area Media -->
            <div class="x3-media">
                <img src="{{ asset('uploads/gallery/'.$g->file) }}" alt="{{ $g->title }}">
            </div>

            <!-- Area Teks (Pemisahan Judul & Deskripsi) -->
            <div class="x3-content">
                <h4 class="x3-title">{{ $g->title }}</h4>
                <div class="x3-divider"></div>
                <p class="x3-description">{{ Str::limit($g->description, 80) }}</p>
                <p class="x3-date">{{ $g->created_at->format('d M Y') }}</p>
            </div>

        </div>
    </div>
    @endforeach
</div>
    </div>
</section>

<!-- LIGHTBOX VIEWER (Hanya Foto) -->
<div id="siluaLightbox" class="lightbox-overlay" onclick="closeLightbox()">
    <button class="close-x">&times;</button>
    <div class="lightbox-inner" onclick="event.stopPropagation()">
        <img id="fullImage" src="" class="animate-zoom">
        <h3 id="lightboxCaption" class="mt-6 text-white text-center font-bold tracking-widest uppercase text-sm"></h3>
    </div>
</div>

<script>
    function openFullImage(src, title) {
        const lightbox = document.getElementById('siluaLightbox');
        const img = document.getElementById('fullImage');
        const caption = document.getElementById('lightboxCaption');

        img.src = src;
        caption.innerText = title;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        document.getElementById('siluaLightbox').classList.remove('active');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection