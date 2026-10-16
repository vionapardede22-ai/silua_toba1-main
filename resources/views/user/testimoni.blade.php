@extends('layouts.user')

@section('title', 'Testimonials - Silua Toba')

@section('content')
<link rel="stylesheet" href="{{ asset('css/testimonial-user.css') }}">

<section class="silua-testi-section">
    <div class="max-w-7xl mx-auto px-6 text-center">
        
        <!-- HEADER -->
        <div class="mb-16">
            <h1 class="testi-main-title">Testimonials</h1>
            <p class="testi-subtitle">Apa kata mereka tentang pengalaman rasa di Silua Toba.</p>
        </div>

        <!-- FORM INPUT (Hanya muncul jika sudah login & belum buat testimoni) -->
        @auth
            @if(!$myTestimony)
            <div class="testi-form-card mb-20">
                <form action="{{ route('testimoni.store') }}" method="POST">
                    @csrf
                    <textarea name="message" placeholder="Tuliskan pengalaman Anda..." required class="silua-input"></textarea>
                    <button type="submit" class="btn-admin-submit-v2 mt-4">Kirim Testimoni</button>
                </form>
            </div>
            @endif
        @endauth

        <!-- GRID TESTIMONI (Gaya Gambar Referensi) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            @foreach($testimonials as $t)
            <div class="testi-card group">
                <!-- Avatar Bulat Tengah -->
                <div class="testi-avatar">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($t->user->name) }}&background=25343F&color=fff" alt="User">
                </div>

                <h4 class="testi-user-name">{{ $t->user->name }}</h4>
                <p class="testi-message">"{{ $t->message }}"</p>

                <!-- Tombol Edit/Hapus Milik Sendiri -->
                @auth
                    @if($t->user_id === Auth::id())
                    <div class="testi-actions">
                        <button onclick="toggleEdit()" class="edit-link">Edit</button>
                        <form action="{{ route('testimoni.destroy', $t->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="delete-link" onclick="return confirm('Hapus?')">Hapus</button>
                        </form>
                    </div>

                    <!-- Hidden Edit Form -->
                    <div id="editTestiForm" class="hidden mt-6">
                        <form action="{{ route('testimoni.update', $t->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <textarea name="message" class="silua-input text-xs">{{ $t->message }}</textarea>
                            <button type="submit" class="btn-orange-tiny mt-2">Simpan</button>
                        </form>
                    </div>
                    @endif
                @endauth
            </div>
            @endforeach
        </div>

        <!-- Pagination Dots (Aesthetic Only) -->
        <div class="flex justify-center gap-3 mt-16">
            <div class="w-2 h-2 rounded-full border border-orange-brand"></div>
            <div class="w-2 h-2 rounded-full border border-orange-brand"></div>
            <div class="w-2 h-2 rounded-full bg-orange-brand"></div>
            <div class="w-2 h-2 rounded-full border border-orange-brand"></div>
        </div>
    </div>
</section>

<script>
    function toggleEdit() {
        document.getElementById('editTestiForm').classList.toggle('hidden');
    }
</script>
@endsection