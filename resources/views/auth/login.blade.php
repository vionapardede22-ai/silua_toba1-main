@extends('layouts.auth')

@section('content')
<div class="auth-page-bg">
    <a href="{{ route('portal') }}" class="back-btn">
        <i data-lucide="arrow-left"></i> <span>Kembali</span>
    </a>

    <div class="auth-card">
        <h2 class="text-2xl auth-title uppercase">SIGN IN {{ $role == 'admin' ? 'ADMIN' : 'PELANGGAN' }}</h2>
        <p class="auth-subtitle">PORTAL AKSES KEAMANAN</p>

        @if ($errors->has('loginError'))
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded-r-2xl flex items-center gap-3 animate-shake">
                <i data-lucide="alert-circle" class="text-red-500 w-5 h-5 flex-shrink-0"></i>
                <p class="text-[11px] text-red-600 font-bold text-left">{{ $errors->first('loginError') }}</p>
            </div>
        @endif

        <form action="{{ $role == 'admin' ? route('admin.login.post') : route('user.login.post') }}" method="POST">
            @csrf
            <div class="text-left mb-5">
                <label class="block text-[10px] font-black text-navy-dark ml-4 mb-2 uppercase opacity-40">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="silua-input" placeholder="Masukkan email anda">
            </div>

            <div class="text-left mb-8">
                <label class="block text-[10px] font-black text-navy-dark ml-4 mb-2 uppercase opacity-40">Password</label>
                <input type="password" name="password" required class="silua-input" placeholder="••••••••">
            </div>

            <button type="submit" class="{{ $role == 'admin' ? 'btn-icon-navy' : 'btn-icon-orange' }}">
                <i data-lucide="log-in"></i>
            </button>
        </form>

        <div class="mt-12">
            @if($role == 'pelanggan')
                <a href="{{ route('user.register') }}" class="text-[11px] font-black text-orange-brand tracking-widest uppercase hover:underline">
                    Belum punya akun? Daftar Sekarang
                </a>
            @else
                <p class="text-[10px] font-bold text-navy-dark opacity-30 uppercase">Akses Terbatas Staff Internal</p>
            @endif
        </div>
    </div>
</div>
@endsection