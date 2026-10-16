@extends('layouts.user')

@section('title','Home')

@section('content')
<link rel="stylesheet" href="{{ asset('css/home-layout.css') }}">

<!-- ==========================================================================
     SECTION 1: HERO SLIDER (BANNER ATAS) - Tetap
     ========================================================================== -->
<section class="hero-slider">
    <div class="slide active">
        <div class="slide-bg"><img src="{{ asset('images/bg1.png') }}"></div>
    </div>
    <div class="slide">
        <div class="slide-bg"><img src="{{ asset('images/bg2.png') }}"></div>
        <div class="slide-content">
            <span class="animate-text">Santapan Terbaik</span>
            <h1 class="animate-text delay-1">KEAJAIBAN <br> <span>DANAU TOBA</span></h1>
            <p class="animate-text delay-2">Bawa pulang kelezatan autentik sebagai cerita manis dari Tanah Batak.</p>
            <div class="hero-btn-container animate-text delay-3">
                <a href="{{ route('user.products') }}" class="btn-slider-primary">Lihat Produk <i data-lucide="arrow-right" class="ml-2"></i></a>
            </div>
        </div>
    </div>
    <div class="slider-dots">
        <span class="dot-hero active" onclick="currentHeroSlide(0)"></span>
        <span class="dot-hero" onclick="currentHeroSlide(1)"></span>
    </div>
</section>

<!-- ==========================================================================
     SECTION 2: SUBWAY-STYLE CAROUSEL (SEAMLESS INFINITE LOOP)
     ========================================================================== -->
<section class="silua-carousel-section">
    <div class="text-center mb-10">
        <h2 class="carousel-hashtag italic uppercase">#SILUATOBA</h2>
    </div>

    <div class="subway-carousel-wrapper">
        <button class="subway-nav-btn prev" onclick="manualMove(-1)"><i data-lucide="chevron-left"></i></button>

        <div class="subway-carousel-container">
            <div class="subway-carousel-track" id="subwayTrack">
                <!-- Item Asli -->
                <div class="subway-item"><div class="subway-card"><img src="{{ asset('images/Tobakopi.jpg') }}"></div></div>
                <div class="subway-item"><div class="subway-card"><img src="{{ asset('images/kacang.jpg') }}"></div></div>
                <div class="subway-item"><div class="subway-card"><img src="{{ asset('images/miegomak.png') }}"></div></div>
                <div class="subway-item"><div class="subway-card"><img src="{{ asset('images/Tobakopi.jpg') }}"></div></div>
                <div class="subway-item"><div class="subway-card"><img src="{{ asset('images/kacang.jpg') }}"></div></div>
            </div>
        </div>

        <button class="subway-nav-btn next" onclick="manualMove(1)"><i data-lucide="chevron-right"></i></button>
    </div>

    <div class="subway-pagination" id="subwayDots"></div>
</section>

<script>
    /* --- HERO SLIDER LOGIC (BANNER ATAS) --- */
    let heroIdx = 0;
    const hSlides = document.querySelectorAll('.slide');
    const hDots = document.querySelectorAll('.dot-hero');
    function showHero(n) {
        hSlides.forEach(s => s.classList.remove('active'));
        hDots.forEach(d => d.classList.remove('active'));
        hSlides[n].classList.add('active'); hDots[n].classList.add('active');
        heroIdx = n;
    }
    function currentHeroSlide(n) { showHero(n); }
    setInterval(() => { showHero((heroIdx + 1) % hSlides.length); }, 8000);

    /* --- SUBWAY SEAMLESS LOOP LOGIC --- */
    const track = document.getElementById('subwayTrack');
    const originalItems = document.querySelectorAll('.subway-item');
    const dotsContainer = document.getElementById('subwayDots');
    
    const totalOriginal = originalItems.length;
    let subwayIndex = 2; // Kita mulai dari index 2 karena ada 2 klon di awal
    let isTransitioning = false;
    let autoPlayInterval;

    // 1. PROSES CLONING (Duplikasi untuk efek tanpa putus)
    const firstTwo = [originalItems[0].cloneNode(true), originalItems[1].cloneNode(true)];
    const lastTwo = [originalItems[totalOriginal - 2].cloneNode(true), originalItems[totalOriginal - 1].cloneNode(true)];

    // Tambah ke akhir
    firstTwo.forEach(clone => track.appendChild(clone));
    // Tambah ke awal (secara terbalik)
    lastTwo.reverse().forEach(clone => track.insertBefore(clone, track.firstChild));

    // Ambil semua item (termasuk klon)
    const allItems = document.querySelectorAll('.subway-item');

    // 2. GENERATE DOTS (Hanya untuk jumlah asli yaitu 5)
    originalItems.forEach((_, i) => {
        const dot = document.createElement('span');
        dot.className = `subway-dot ${i === 0 ? 'active' : ''}`;
        dot.onclick = () => jumpToSlide(i);
        dotsContainer.appendChild(dot);
    });
    const dots = document.querySelectorAll('.subway-dot');

    function updateSubway(animate = true) {
        if (!animate) track.style.transition = 'none';
        else track.style.transition = 'transform 0.7s cubic-bezier(0.4, 0, 0.2, 1)';

        const containerWidth = document.querySelector('.subway-carousel-container').offsetWidth;
        const itemWidth = originalItems[0].offsetWidth;
        const gap = 20; 

        // Hitung posisi
        const offset = (containerWidth / 2) - (itemWidth / 2) - (subwayIndex * (itemWidth + gap));
        track.style.transform = `translateX(${offset}px)`;

        // Update Class Active (untuk efek Scale & Blur)
        allItems.forEach((item, i) => {
            item.classList.toggle('active', i === subwayIndex);
        });

        // Update Dots (Cek index asli)
        let activeDot = (subwayIndex - 2) % totalOriginal;
        if (activeDot < 0) activeDot = totalOriginal - 1;
        dots.forEach((dot, i) => dot.classList.toggle('active', i === activeDot));
    }

    // 3. LOGIKA JUMP (Rahasia Infinite)
    track.addEventListener('transitionend', () => {
        isTransitioning = false;
        // Jika sampai di klon akhir, lompat ke asli awal
        if (subwayIndex >= totalOriginal + 2) {
            subwayIndex = 2;
            updateSubway(false);
        }
        // Jika sampai di klon awal, lompat ke asli akhir
        if (subwayIndex <= 1) {
            subwayIndex = totalOriginal + 1;
            updateSubway(false);
        }
    });

    function moveSubwaySlide(step) {
        if (isTransitioning) return;
        isTransitioning = true;
        subwayIndex += step;
        updateSubway(true);
    }

    function manualMove(step) {
        moveSubwaySlide(step);
        resetTimer();
    }

    function jumpToSlide(i) {
        if (isTransitioning) return;
        subwayIndex = i + 2;
        updateSubway(true);
        resetTimer();
    }

    function startTimer() {
        autoPlayInterval = setInterval(() => moveSubwaySlide(1), 5000);
    }

    function resetTimer() {
        clearInterval(autoPlayInterval);
        startTimer();
    }

    // Inisialisasi
    window.onload = () => {
        updateSubway(false); 
        startTimer();
        lucide.createIcons();
    };
    window.onresize = () => updateSubway(false);
</script>
@endsection