<header id="navbar" class="fixed top-0 left-0 w-full z-50 flex items-center justify-between px-6 md:px-12 py-4 transition-all duration-300">

    <!-- SISI KIRI: LOGO (Box Gantung) -->
    <div class="flex items-center">
        <div class="silua-logo-box shadow-xl">
            <img src="{{ asset('images/logo.jpeg') }}" class="w-14 h-14 md:w-16 md:h-16 rounded-full border-2 border-white shadow-md">
        </div>
    </div>

    <!-- SISI TENGAH: NAVIGASI (Kapsul Utama) -->
    <div class="hidden md:flex silua-nav-pill shadow-lg">
        <nav class="flex items-center gap-1 font-medium text-white text-sm">
            
            <a href="/" class="silua-nav-item {{ Request::is('/') ? 'active-pill' : '' }}">
                Home
            </a>
            
            <a href="{{ route('user.profile') }}" class="silua-nav-item {{ Request::is('profil*') ? 'active-pill' : '' }}">
                Profil
            </a>
            
            <a href="{{ route('user.products') }}" class="silua-nav-item {{ Request::is('products*') ? 'active-pill' : '' }}">
                Produk
            </a>

            <a href="{{ route('user.gallery') }}" class="silua-nav-item {{ Request::is('galeri*') ? 'active-pill' : '' }}">
                Galeri
            </a>

            <a href="{{ route('user.testimoni') }}" class="silua-nav-item {{ Request::is('testimoni*') ? 'active-pill' : '' }}">
                Testimoni
            </a>

            <a href="{{ route('user.about') }}" class="silua-nav-item {{ Request::is('about*') ? 'active-pill' : '' }}">
                About
            </a>
            
        </nav>
    </div>

    <!-- SISI KANAN: IKON & USER (Kapsul Aksi) -->
    <div class="flex items-center silua-action-pill shadow-lg">

        <!-- 1. Wishlist (Hati) -->
        <a href="{{ route('user.wishlist') }}" class="nav-icon-link relative" title="Wishlist">
            <i data-lucide="heart" class="w-5 h-5"></i>
            @auth
                @php 
                    $wishCount = \App\Models\Wishlist::where('user_id', auth()->id())->count(); 
                @endphp
                @if($wishCount > 0)
                    <span class="absolute -top-2 -right-2 bg-orange-brand text-[9px] w-4 h-4 flex items-center justify-center rounded-full font-black text-navy-dark shadow border border-white">
                        {{ $wishCount }}
                    </span>
                @endif
            @endauth
        </a>

        <!-- 2. CART (Troli) -->
        <div class="relative cursor-pointer group flex items-center justify-center" onclick="toggleCart()" style="width: 30px; height: 30px;" title="Buka Keranjang">
            <i data-lucide="shopping-cart" class="w-5 h-5 group-hover:text-orange-brand transition"></i>
            @auth
                @php
                    $totalItem = \App\Models\Cart::where('user_id', auth()->id())->sum('quantity');
                @endphp
                @if($totalItem > 0)
                    <span class="cart-badge-nav">{{ $totalItem }}</span>
                @endif
            @endauth
        </div>

        <!-- 3. AUTH SECTION -->
        @auth
            <div class="pill-divider"></div>

            <div class="user-profile-info">
                <p class="user-name">{{ Auth::user()->name }}</p>
                <p class="user-id">{{ Auth::user()->customer_id }}</p>
            </div>

            <form action="{{ route('logout') }}" method="POST" class="m-0 flex items-center">
                @csrf
                <button type="submit" class="logout-icon-btn" title="Keluar">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                </button>
            </form>
        @else
            <div class="pill-divider"></div>
            <a href="{{ route('portal') }}" class="nav-icon-link" title="Masuk / Daftar">
                <i data-lucide="user" class="w-5 h-5"></i>
            </a>
        @endauth
    </div>

</header>