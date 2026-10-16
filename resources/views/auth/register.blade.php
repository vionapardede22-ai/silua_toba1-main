@extends('layouts.auth')

@section('content')
<div class="auth-page-bg">
    <a href="{{ route('user.login') }}" class="back-btn">
        <i data-lucide="arrow-left"></i> <span>Batal</span>
    </a>

    <div class="auth-card" style="max-width: 550px;">
        <h2 class="text-2xl auth-title uppercase">CREATE ACCOUNT</h2>
        <p class="auth-subtitle">BERGABUNG DENGAN SILUA TOBA</p>

        <form action="{{ route('user.register.post') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="text-left">
                    <label class="block text-[10px] font-black text-navy-dark ml-4 mb-1 uppercase opacity-40">First Name</label>
                    <input type="text" name="first_name" required class="silua-input">
                </div>
                <div class="text-left">
                    <label class="block text-[10px] font-black text-navy-dark ml-4 mb-1 uppercase opacity-40">Last Name</label>
                    <input type="text" name="last_name" required class="silua-input">
                </div>
            </div>

            <div class="text-left">
                <label class="block text-[10px] font-black text-navy-dark ml-4 mb-1 uppercase opacity-40">Email Address</label>
                <input type="email" name="email" required class="silua-input" placeholder="name@example.com">
            </div>

            <div class="text-left">
                <label class="block text-[10px] font-black text-navy-dark ml-4 mb-1 uppercase opacity-40">Password</label>
                <input type="password" name="password" required class="silua-input" placeholder="Min 6 karakter">
            </div>

            <div class="text-left">
                <label class="block text-[10px] font-black text-navy-dark ml-4 mb-1 uppercase opacity-40">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="silua-input">
            </div>

            <button type="submit" class="btn-icon-orange mt-6">
                <i data-lucide="user-plus"></i>
            </button>
        </form>

        <p class="mt-10 text-[9px] text-navy-dark opacity-30 uppercase tracking-widest px-10">
            Dapatkan ID Pelanggan otomatis untuk kemudahan memesan di Silua Toba.
        </p>
    </div>
</div>
@endsection