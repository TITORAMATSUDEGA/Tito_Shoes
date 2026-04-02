<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tito Shoes Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="user-theme-bg user-theme-text font-sans pt-20">

    @php
        $sizes = ['38', '39', '40', '41', '42', '43', '44'];
        $colors = ['Hitam', 'Putih', 'Navy', 'Abu-abu', 'Merah'];
        $cart = session('cart', []);
        $cartCount = collect($cart)->sum('quantity');
    @endphp

    <nav class="user-theme-surface user-theme-border border-b shadow-sm py-4 fixed top-0 left-0 w-full z-50">
        <div class="max-w-6xl mx-auto px-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold user-theme-text">👟 Tito<span class="user-theme-accent">Shoes</span></h1>
            <a href="{{ route('cart.index') }}" class="relative inline-flex items-center justify-center w-10 h-10 rounded-full user-theme-soft-accent transition" aria-label="Keranjang">
                <svg class="w-6 h-6 user-theme-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.5 7h13M10 21a1 1 0 100-2 1 1 0 000 2zm8 0a1 1 0 100-2 1 1 0 000 2z"/></svg>
                @if($cartCount > 0)
                    <span class="absolute -top-1 -right-1 user-theme-badge text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-10 text-center">
        <h2 class="text-3xl font-bold user-theme-text mb-4">Koleksi Sepatu Terbaik</h2>
        <p class="user-theme-muted">Pilih sepatu favoritmu dan langsung pesan dengan mudah via WhatsApp!</p>
    </div>

    <div class="max-w-6xl mx-auto px-4 pb-16">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
            
            @foreach($shoes as $shoe)
            <div class="user-theme-surface user-theme-border border rounded-2xl shadow-md overflow-hidden transition transform hover:-translate-y-2 hover:shadow-xl">
                @if(Str::startsWith($shoe->image, 'http') || Str::startsWith($shoe->image, 'images/'))
                    <img src="{{ Str::startsWith($shoe->image, 'http') ? $shoe->image : asset($shoe->image) }}" alt="{{ $shoe->name }}" class="w-full h-64 object-cover">
                @else
                    <img src="{{ Storage::url($shoe->image) }}" alt="{{ $shoe->name }}" class="w-full h-64 object-cover">
                @endif
                
                <div class="p-6">
                    <h3 class="text-xl font-bold user-theme-text mb-2">{{ $shoe->name }}</h3>
                    <p class="user-theme-muted text-sm mb-4 line-clamp-2">{{ $shoe->description }}</p>
                    
                    <div class="text-2xl font-extrabold user-theme-text mb-6">
                        Rp {{ number_format($shoe->price, 0, ',', '.') }}
                    </div>
                    
                    <div class="flex justify-center">
                        <button
                            type="button"
                            class="inline-flex items-center justify-center user-theme-btn font-semibold text-sm py-2 px-4 rounded-xl transition js-open-variant"
                            data-shoe-id="{{ $shoe->id }}"
                            data-shoe-name="{{ $shoe->name }}"
                            data-shoe-price="{{ $shoe->price }}"
                        >
                            + Keranjang
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    <div id="variant-modal" class="fixed inset-0 bg-black/45 backdrop-blur-sm hidden items-center justify-center z-50">
        <div class="user-theme-surface user-theme-border w-[92%] max-w-md rounded-[28px] p-6 shadow-[0_20px_60px_-20px_rgba(15,23,42,0.35)] border">
            <div class="flex items-center justify-between mb-5">
                <h4 class="text-lg font-bold user-theme-text">Pilih Variasi</h4>
                <button type="button" id="variant-close" class="w-9 h-9 rounded-full border user-theme-border user-theme-muted hover:text-slate-700 transition">✕</button>
            </div>
            <form action="{{ route('cart.add') }}" method="POST" class="space-y-4" id="variant-form">
                @csrf
                <input type="hidden" name="shoe_id" id="variant-shoe-id">
                <div class="pb-3 border-b user-theme-border">
                    <p class="text-base font-semibold user-theme-text" id="variant-shoe-name"></p>
                    <p class="text-base user-theme-accent font-bold" id="variant-shoe-price"></p>
                </div>
                <div>
                    <label class="block text-[11px] font-semibold user-theme-muted mb-2 uppercase tracking-wider">Ukuran</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($sizes as $size)
                            <label class="inline-flex items-center">
                                <input type="radio" name="size" value="{{ $size }}" class="peer hidden" required>
                                <span class="px-3 py-1.5 border user-theme-border rounded-full text-sm font-medium user-theme-text user-theme-surface shadow-[0_1px_0_rgba(15,23,42,0.03)] peer-checked:border-[var(--user-accent)] peer-checked:bg-[var(--user-soft-accent)] peer-checked:text-[var(--user-accent)]">{{ $size }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <label class="block text-[11px] font-semibold user-theme-muted mb-2 uppercase tracking-wider">Warna</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($colors as $color)
                            <label class="inline-flex items-center">
                                <input type="radio" name="color" value="{{ $color }}" class="peer hidden" required>
                                <span class="px-3 py-1.5 border user-theme-border rounded-full text-sm font-medium user-theme-text user-theme-surface shadow-[0_1px_0_rgba(15,23,42,0.03)] peer-checked:border-[var(--user-accent)] peer-checked:bg-[var(--user-soft-accent)] peer-checked:text-[var(--user-accent)]">{{ $color }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="flex items-end gap-3">
                    <div class="flex-1">
                        <label class="block text-[11px] font-semibold user-theme-muted mb-2 uppercase tracking-wider">Kuantiti</label>
                        <input type="number" name="quantity" min="1" max="99" value="1" required class="w-full h-11 border user-theme-border rounded-xl px-3 text-center text-sm focus:ring-2 focus:ring-[var(--user-accent)] focus:border-transparent">
                    </div>
                    <button type="submit" class="flex-1 h-11 user-theme-btn font-semibold rounded-xl transition inline-flex items-center justify-center gap-2 shadow-[0_10px_24px_-14px_rgba(15,118,110,0.7)]">
                        + Keranjang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const variantModal = document.getElementById('variant-modal');
            const variantCloseBtn = document.getElementById('variant-close');
            const openVariantButtons = document.querySelectorAll('.js-open-variant');
            const variantForm = document.getElementById('variant-form');
            const shoeIdInput = document.getElementById('variant-shoe-id');
            const shoeName = document.getElementById('variant-shoe-name');
            const shoePrice = document.getElementById('variant-shoe-price');

            const openModal = (el) => {
                if (!el) return;
                el.classList.remove('hidden');
                el.classList.add('flex');
            };

            const closeModal = (el) => {
                if (!el) return;
                el.classList.add('hidden');
                el.classList.remove('flex');
            };

            openVariantButtons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    if (variantForm) {
                        variantForm.reset();
                    }

                    if (shoeIdInput) shoeIdInput.value = btn.dataset.shoeId || '';
                    if (shoeName) shoeName.textContent = btn.dataset.shoeName || '';
                    if (shoePrice) {
                        const price = parseInt(btn.dataset.shoePrice || '0', 10);
                        shoePrice.textContent = 'Rp ' + price.toLocaleString('id-ID');
                    }
                    openModal(variantModal);
                });
            });

            if (variantForm) {
                variantForm.addEventListener('submit', (event) => {
                    if (!shoeIdInput || !shoeIdInput.value) {
                        event.preventDefault();
                        alert('Produk belum dipilih. Silakan klik tombol + Keranjang pada produk yang diinginkan.');
                    }
                });
            }

            if (variantCloseBtn) {
                variantCloseBtn.addEventListener('click', () => closeModal(variantModal));
            }

            if (variantModal) {
                variantModal.addEventListener('click', (event) => {
                    if (event.target === variantModal) {
                        closeModal(variantModal);
                    }
                });
            }

        });
    </script>

</body>
</html>