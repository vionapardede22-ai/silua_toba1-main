@extends('layouts.user')

@section('title', 'Katalog Produk Silua Toba')

@section('content')
<link rel="stylesheet" href="{{ asset('css/produk-user.css') }}">
<link rel="stylesheet" href="{{ asset('css/modal-produk.css') }}">

<section class="silua-products-section">
    <div class="products-container">
        
        <!-- HEADER & SEARCH -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-16 gap-8">
            <div class="text-center md:text-left">
                <span class="products-subtitle">Pilihan Terbaik</span>
                <h2 class="products-title">Katalog Produk</h2>
            </div>
            
            <div class="search-container-v2">
                <form action="{{ route('user.products') }}" method="GET">
                    <i data-lucide="search" class="search-icon-v2"></i>
                    <input type="text" name="search" placeholder="Cari rasa favoritmu..." class="search-input-v2" value="{{ request('search') }}">
                </form>
            </div>
        </div>

        <!-- GRID PRODUK -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">
            @forelse ($products as $p)
            <div class="product-premium-card show">

                <!-- MEDIA + WISHLIST -->
                <div class="product-media relative">
                    <img src="{{ asset('uploads/products/' . $p->image) }}" alt="{{ $p->name }}">
                    
                    @auth
                        <form action="{{ route('wishlist.toggle') }}" method="POST" class="absolute top-3 right-3 z-20">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                            @php 
                                $isWishlisted = \App\Models\Wishlist::where('user_id', auth()->id())
                                                    ->where('product_id', $p->id)
                                                    ->exists();
                            @endphp
                            <button type="submit" class="wish-btn-v2 {{ $isWishlisted ? 'active' : '' }}" style="cursor: pointer;">
                                <i data-lucide="heart" fill="{{ $isWishlisted ? '#ef4444' : 'none' }}" style="color: {{ $isWishlisted ? '#ef4444' : 'inherit' }}"></i>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('user.register') }}" class="absolute top-3 right-3 z-20 wish-btn-v2">
                            <i data-lucide="heart"></i>
                        </a>
                    @endauth
                </div>

                <!-- INFO PRODUK -->
                <div class="product-info-v2">
                    <p class="product-cat-v2">{{ $p->category }}</p>
                    <h3 class="product-name-v2">{{ $p->name }}</h3>
                    
                    <!-- Rating Summary di Katalog -->
                    <div class="flex justify-center text-yellow-500 mb-3 gap-1">
                        @php $avgRating = round($p->reviews->avg('rating') ?? 0); @endphp
                        @for($i=1; $i<=5; $i++)
                            <i data-lucide="star" class="w-3 h-3" fill="{{ $i <= $avgRating ? 'currentColor' : 'none' }}"></i>
                        @endfor
                        <span class="text-[9px] text-gray-400 font-bold ml-1">({{ $p->reviews->count() }})</span>
                    </div>
                    
                    <div class="product-footer-v2">
                        <div class="text-left">
                            <span class="price-label-v2">Harga</span>
                            <span class="price-value-v2">Rp {{ number_format($p->price, 0, ',', '.') }}</span>
                        </div>
                        
                        @auth
                        <button type="button" class="buy-btn-v2 btn-navy-v2"
                            onclick="openOrderModal(
                                '{{ $p->id }}',
                                '{{ addslashes($p->name) }}',
                                '{{ $p->price }}',
                                '{{ asset('uploads/products/'.$p->image) }}',
                                '{{ addslashes($p->description) }}',
                                {{ $p->reviews->load('user')->toJson() }}
                            )">
                            <i data-lucide="shopping-cart"></i>
                        </button>
                        @else
                        <a href="{{ route('user.register') }}" class="buy-btn-v2 btn-orange-v2"><i data-lucide="user-plus"></i></a>
                        @endauth
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20 opacity-30">
                <i data-lucide="package-search" class="w-20 h-20 mx-auto mb-4 text-navy-dark"></i>
                <p class="text-xl font-bold uppercase tracking-widest text-navy-dark">Belum ada produk</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@include('components.modal-detail-produk')


<script>
const currentUserId = {{ auth()->id() ?? 'null' }};

function openOrderModal(id, name, price, img, desc, reviews = []){
    // Reset Data Dasar
    document.getElementById('m-id').value = id;
    if(document.getElementById('rev-prod-id')) document.getElementById('rev-prod-id').value = id;
    document.getElementById('m-name').innerText = name;
    document.getElementById('m-price').innerText = "Rp " + new Intl.NumberFormat('id-ID').format(price);
    document.getElementById('m-img').src = img;
    document.getElementById('m-desc').innerText = desc || "Cita rasa autentik khas Toba.";
    document.getElementById('m-qty').value = 1;

    // Render Ulasan
    const container = document.getElementById('m-reviews-container');
    const countLabel = document.getElementById('m-review-count-label');
    container.innerHTML = '';
    countLabel.innerText = `(${reviews.length} Ulasan)`;

    if (reviews.length > 0) {
        reviews.forEach(rev => {
            let starsHTML = '';
            const r = parseInt(rev.rating); 
            for(let i=1; i<=5; i++) {
                if(i <= r) {
                    starsHTML += `<i data-lucide="star" class="w-3 h-3 text-yellow-500" fill="#fbbf24" stroke="#fbbf24"></i>`;
                } else {
                    starsHTML += `<i data-lucide="star" class="w-3 h-3 text-gray-300" fill="none" stroke="#cbd5e1"></i>`;
                }
            }

            let actions = '';
            if(currentUserId && rev.user_id === currentUserId) {
                actions = `
                    <div class="flex gap-3 mt-4 border-t pt-3">
                        <button onclick="editReview(${rev.id}, ${rev.rating}, '${rev.comment.replace(/'/g, "\\'")}')" class="text-[10px] font-bold text-navy-dark underline uppercase">Edit</button>
                        <form action="/review/delete/${rev.id}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-[10px] font-bold text-red-500 underline uppercase">Hapus</button>
                        </form>
                    </div>
                `;
            }
            
            container.innerHTML += `
                <div class="review-card-modern" style="background:#f8fafc; padding:25px; border-radius:2rem; border:1px solid #edf2f7;">
                    <div class="flex justify-between mb-3">
                        <div class="flex gap-1">${starsHTML}</div>
                        <span class="text-[9px] text-gray-400 font-bold uppercase">${new Date(rev.created_at).toLocaleDateString('id-ID')}</span>
                    </div>
                    <p class="font-black text-navy-dark text-sm flex items-center gap-2">
                        ${rev.user ? rev.user.name : 'Pelanggan'} <i data-lucide="check-circle" class="w-3 h-3 text-green-500"></i>
                    </p>
                    <p class="text-xs text-gray-500 mt-2 italic leading-relaxed">"${rev.comment}"</p>
                    ${actions}
                </div>
            `;
        });
    } else {
        container.innerHTML = '<p class="col-span-full text-center text-gray-400 italic py-10">Belum ada ulasan untuk produk ini.</p>';
    }

    document.getElementById('modalOrder').classList.add('active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => lucide.createIcons(), 50);
}

function setRating(n) {
    document.getElementById('selected-rating').value = n;
    const stars = document.querySelectorAll('#star-input .star-btn');
    stars.forEach((star, index) => {
        if (index < n) {
            star.classList.add('text-yellow-500');
            star.setAttribute('fill', '#fbbf24');
        } else {
            star.classList.remove('text-yellow-500');
            star.setAttribute('fill', 'none');
        }
    });
}

function toggleReviewForm() {
    const form = document.getElementById('reviewFormSection');
    form.classList.toggle('hidden');
    document.getElementById('rev-comment').value = '';
    document.getElementById('submit-review-text').innerText = "KIRIM ULASAN SEKARANG";
    setRating(5);
}

function editReview(id, rating, comment) {
    document.getElementById('reviewFormSection').classList.remove('hidden');
    document.getElementById('rev-comment').value = comment;
    document.getElementById('submit-review-text').innerText = "SIMPAN PERUBAHAN";
    setRating(rating);
    document.getElementById('reviewFormSection').scrollIntoView({ behavior: 'smooth' });
}

function closeModal(){
    document.getElementById('modalOrder').classList.remove('active');
    document.body.style.overflow = 'auto';
    if(document.getElementById('reviewFormSection')) document.getElementById('reviewFormSection').classList.add('hidden');
}

function changeQty(val){
    let qty = document.getElementById('m-qty');
    let current = parseInt(qty.value);
    if(current + val >= 1) qty.value = current + val;
}
</script>
@endsection