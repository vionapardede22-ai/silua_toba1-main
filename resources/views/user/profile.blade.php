@extends('layouts.user')

@section('title', 'Profil Perusahaan - Silua Toba')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile-user.css') }}">

<!-- SECTION 1: HERO (MENGGUNAKAN GAMBAR UTUH SESUAI PERMINTAAN) -->
<section class="profile-hero-full-image">
    <!-- Memanggil gambar banner yang Anda kirim -->
    <img src="{{ asset('images/bg_profil.png') }}" alt="Profil Silua Toba Banner" class="banner-img">
</section>

<!-- SECTION 2: SEJARAH -->
<section class="py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <!-- Teks di Kiri -->
        <div class="text-content-wrapper">
            <h2 class="section-title-navy">Tentang <span class="text-orange-brand">Silua Toba</span></h2>
            <div class="h-1.5 w-20 bg-orange-brand my-6 rounded-full"></div>
            
            <div class="history-text text-gray-600 leading-relaxed">
                {!! nl2br(e($info->history_text ?? 'Silua Toba hadir sebagai pusat oleh-oleh khas Toba yang mengedepankan kualitas dan keaslian rasa.')) !!}
            </div>
        </div>

        <!-- Gambar Tambahan (Dokumentasi) -->
        <div class="relative group">
            <div class="about-image-card">
                <img src="{{ asset('images/bg1.png') }}" class="w-full h-full object-cover">
            </div>
            <div class="decorative-blob"></div>
        </div>
    </div>
</section>

<!-- SECTION 3: VISI & MISI -->
<section class="py-24 bg-light-bg">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="section-title-navy">Visi & Misi Kami</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Misi -->
            <div class="vision-mission-card border-orange">
                <div class="vm-icon-box bg-orange">
                    <i data-lucide="target" class="text-white"></i>
                </div>
                <h3>Misi</h3>
                <div class="vm-desc">
                    <p>{{ $info->mission ?? 'Misi belum diisi.' }}</p>
                </div>
            </div>
            <!-- Visi -->
            <div class="vision-mission-card border-navy">
                <div class="vm-icon-box bg-navy">
                    <i data-lucide="eye" class="text-white"></i>
                </div>
                <h3>Visi</h3>
                <div class="vm-desc">
                    <p>{{ $info->vision ?? 'Visi belum diisi.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION 4: TIM (STAFF & OWNER) -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h2 class="section-title-navy mb-4">Tim Silua Toba</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mt-12">
            @forelse($teams as $t)
            <div class="staff-card group">
                <div class="staff-img-box">
                    <img src="{{ asset('uploads/teams/'.$t->photo) }}" class="grayscale group-hover:grayscale-0 transition-all duration-500">
                </div>
                <h4 class="font-black text-navy-dark text-xl mt-6">{{ $t->name }}</h4>
                <p class="text-orange-brand font-bold text-[10px] uppercase tracking-widest mt-1">{{ $t->position }}</p>
            </div>
            @empty
                <p class="col-span-full text-gray-400 italic">Data tim belum dimasukkan.</p>
            @endforelse
        </div>
    </div>
</section>

<!-- SECTION 5: MAPS -->
<section class="py-24 bg-navy-dark relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div>
            <h2 class="text-5xl font-black text-white italic leading-tight">Temukan <br> <span class="text-orange-brand">Kami</span></h2>
            <p class="text-gray-400 mt-6 max-w-sm">Kunjungi outlet resmi kami dan rasakan langsung kehangatan bumbu khas Toba.</p>
        </div>
        <div class="map-card shadow-2xl">
            <iframe src="{{ $info->map_embed ?? '' }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</section>
@endsection