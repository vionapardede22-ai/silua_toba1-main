@extends('layouts.auth')

@section('content')
<div class="auth-page-bg">
    <a href="{{ url('/') }}" class="back-btn">
        <i data-lucide="arrow-left"></i> <span>Kembali</span>
    </a>

    <div class="auth-card">
        <h2 class="text-2xl auth-title uppercase">LOGIN PORTAL</h2>
        <p class="auth-subtitle uppercase">Silahkan pilih peran anda</p>

        <div class="flex flex-col items-center gap-8">
            <a href="{{ route('admin.login') }}" class="btn-icon-navy" title="Masuk Admin">
                <i data-lucide="user-cog"></i>
            </a>
            <a href="{{ route('user.login') }}" class="btn-icon-orange" title="Masuk Pelanggan">
    <i data-lucide="users"></i>
</a>
        </div>

        <p class="mt-12 text-[10px] font-bold text-navy-dark opacity-30 uppercase tracking-[0.2em]">
            Silua Toba &copy; 2026
        </p>
    </div>
</div>
@endsection