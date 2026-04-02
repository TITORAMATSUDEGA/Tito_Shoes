<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Tito Shoes Store</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="user-theme-bg user-theme-text font-sans">
    @php
        $cart = session('cart', []);
        if (!is_array($cart)) {
            $cart = [];
        }

        $cartTotal = collect($cart)->sum(function ($item) {
            return ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
        });

        $waBaseUrl = "https://wa.me/{$wa_number}";
        $pesanCart = "Halo kak, saya mau pesan:\n";
        foreach ($cart as $item) {
            $lineTotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
            $pesanCart .= "- {$item['name']} ({$item['size']}, {$item['color']}) x{$item['quantity']} = Rp " . number_format($lineTotal, 0, ',', '.') . "\n";
        }
        $pesanCart .= "Total: Rp " . number_format($cartTotal, 0, ',', '.') . "\n";
        $pesanCart .= "Mohon konfirmasi ketersediaan dan ongkir.";
        $urlCart = urlencode($pesanCart);
    @endphp

    <nav class="user-theme-surface border-b user-theme-border shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-3.5 md:py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 user-theme-muted hover:user-theme-text font-semibold transition-colors">
                <span aria-hidden="true">←</span>
                Kembali Belanja
            </a>
            <h1 class="text-base md:text-xl font-bold user-theme-text">Keranjang Belanja</h1>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-3 md:px-4 pt-4 pb-8 md:pt-6 md:pb-6">
        @if(empty($cart))
            <div class="p-8 text-center user-theme-surface rounded-2xl border border-dashed user-theme-border">
                <p class="text-base font-semibold user-theme-text">Keranjang masih kosong.</p>
                <p class="text-sm user-theme-muted mt-1">Tambahkan produk dulu untuk lanjut pembelian via WhatsApp.</p>
                <a href="{{ url('/') }}" class="inline-flex mt-4 user-theme-btn font-semibold text-sm py-2 px-4 rounded-xl transition">Lihat Produk</a>
            </div>
        @else
            <div class="user-theme-surface border user-theme-border rounded-2xl overflow-hidden shadow-sm pb-44 md:pb-36">
                <div class="px-4 md:px-5 py-3.5 md:py-4 border-b user-theme-border flex items-center gap-3">
                    <span class="inline-flex items-center rounded-md user-theme-soft-accent px-2 py-0.5 text-xs font-semibold">Store</span>
                    <h2 class="text-sm md:text-lg font-semibold user-theme-text">Tito Shoes Store</h2>
                </div>

                <div class="divide-y divide-[var(--user-border)]/70">
                    @foreach($cart as $key => $item)
                        @php
                            $lineTotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                        @endphp
                        <div class="js-cart-item px-4 md:px-5 py-4 last:pb-16 md:last:pb-20" data-key="{{ $key }}" data-name="{{ $item['name'] }}" data-size="{{ $item['size'] }}" data-color="{{ $item['color'] }}" data-price="{{ $item['price'] }}" data-qty="{{ $item['quantity'] }}">
                            <div class="grid grid-cols-[auto,96px,minmax(0,1fr)] md:grid-cols-[auto,112px,minmax(0,1fr),130px,130px,150px] gap-3 md:gap-4 items-start md:items-center">
                                <label class="pt-1 md:pt-0 shrink-0">
                                    <input type="checkbox" class="js-cart-item-checkbox w-4 h-4 rounded border-[var(--user-border)] text-[var(--user-accent)] focus:ring-[var(--user-accent)]" checked>
                                </label>

                                <div class="w-24 h-24 md:w-28 md:h-28 user-theme-surface rounded-xl border user-theme-border overflow-hidden shrink-0 flex items-center justify-center">
                                    @if(Str::startsWith($item['image'], 'http') || Str::startsWith($item['image'], 'images/'))
                                        <img src="{{ Str::startsWith($item['image'], 'http') ? $item['image'] : asset($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain p-1.5">
                                    @else
                                        <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}" class="w-full h-full object-contain p-1.5">
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <div class="flex items-start justify-between gap-2">
                                        <h3 class="font-semibold user-theme-text text-sm md:text-base leading-5 line-clamp-2">{{ $item['name'] }}</h3>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="shrink-0 md:hidden">
                                            @csrf
                                            <input type="hidden" name="key" value="{{ $key }}">
                                            <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-700 transition">Hapus</button>
                                        </form>
                                    </div>
                                    <p class="mt-1 text-xs md:text-sm user-theme-muted leading-5">Variasi: <span class="user-theme-text">Ukuran {{ $item['size'] }} | {{ $item['color'] }}</span></p>

                                    <div class="mt-2 flex items-center justify-between gap-3 md:hidden">
                                        <div class="inline-flex items-center rounded-md border user-theme-border user-theme-surface overflow-hidden w-fit">
                                            <span class="w-8 h-8 flex items-center justify-center text-xl leading-none user-theme-muted select-none">−</span>
                                            <span class="w-10 h-8 flex items-center justify-center text-sm font-medium user-theme-text border-x user-theme-border">{{ $item['quantity'] }}</span>
                                            <span class="w-8 h-8 flex items-center justify-center text-xl leading-none user-theme-muted select-none">+</span>
                                        </div>
                                        <p class="text-sm font-semibold user-theme-accent">Rp{{ number_format($lineTotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>

                                <div class="hidden md:block text-center">
                                    <p class="text-sm font-semibold user-theme-text">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>

                                <div class="hidden md:inline-flex items-center rounded-md border user-theme-border user-theme-surface overflow-hidden w-fit">
                                    <span class="w-9 h-9 flex items-center justify-center text-2xl leading-none user-theme-muted select-none">−</span>
                                    <span class="w-12 h-9 flex items-center justify-center text-base font-medium user-theme-text border-x user-theme-border">{{ $item['quantity'] }}</span>
                                    <span class="w-9 h-9 flex items-center justify-center text-2xl leading-none user-theme-muted select-none">+</span>
                                </div>

                                <div class="hidden md:block text-right">
                                    <p class="text-base font-semibold user-theme-accent">Rp{{ number_format($lineTotal, 0, ',', '.') }}</p>
                                    <form action="{{ route('cart.remove') }}" method="POST" class="mt-1">
                                        @csrf
                                        <input type="hidden" name="key" value="{{ $key }}">
                                        <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-700 transition">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="h-10 md:h-15"></div>
            </div>

            <div class="h-10 md:h-12"></div>

            <div class="fixed left-0 right-0 bottom-0 user-theme-surface border-t user-theme-border">
                <div class="max-w-6xl mx-auto px-3 md:px-4 py-3 flex flex-col gap-3 md:flex-row md:items-center md:justify-between md:gap-4">
                    <label class="inline-flex items-center gap-2 text-sm md:text-base user-theme-muted font-medium select-none">
                        <input type="checkbox" id="cart-select-all" class="w-4 h-4 rounded border-[var(--user-border)] text-[var(--user-accent)] focus:ring-[var(--user-accent)] shrink-0" checked>
                        Semua
                    </label>

                    <div class="w-auto md:min-w-[245px] text-center select-none py-1 md:h-[76px] md:flex md:items-center md:justify-center">
                        <p class="text-xl md:text-2xl font-bold leading-none user-theme-text md:mt-1">
                            <span class="text-sm font-bold user-theme-muted mr-2">Total</span><span id="cart-selected-total" class="user-theme-accent">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                        </p>
                    </div>

                    <div class="w-[255px] sm:w-[275px] md:w-[300px]">
                        <a
                            id="cart-whatsapp-checkout"
                            data-wa-base="{{ $waBaseUrl }}"
                            data-log-url="{{ route('orders.log') }}"
                            data-csrf="{{ csrf_token() }}"
                            href="{{ $waBaseUrl . '?text=' . $urlCart }}"
                            class="w-full user-theme-btn font-bold py-2.5 md:py-0 px-5 rounded-xl transition flex justify-center items-center text-base md:text-lg select-none shadow-[0_10px_24px_-14px_rgba(15,118,110,0.7)] md:h-[76px]"
                        >
                            Checkout WhatsApp (<span id="cart-selected-count">{{ count($cart) }}</span>)
                        </a>
                        <p id="cart-empty-selection" class="hidden mt-2 text-xs text-red-500">Pilih minimal 1 produk untuk checkout.</p>
                    </div>
                </div>
            </div>
        @endif
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartSelectAll = document.getElementById('cart-select-all');
            const cartItemCheckboxes = Array.from(document.querySelectorAll('.js-cart-item-checkbox'));
            const cartSelectedTotal = document.getElementById('cart-selected-total');
            const cartSelectedCount = document.getElementById('cart-selected-count');
            const cartCheckoutLink = document.getElementById('cart-whatsapp-checkout');
            const cartEmptySelection = document.getElementById('cart-empty-selection');

            const formatRupiah = (value) => {
                return 'Rp ' + Number(value).toLocaleString('id-ID');
            };

            const getSelectedItemElements = () => {
                return cartItemCheckboxes
                    .filter((checkbox) => checkbox.checked)
                    .map((checkbox) => checkbox.closest('.js-cart-item'))
                    .filter(Boolean);
            };

            const buildSelectedOrderPayload = (selectedItems) => {
                return selectedItems.map((itemEl) => ({
                    key: itemEl.dataset.key || '',
                    name: itemEl.dataset.name || 'Produk',
                    size: itemEl.dataset.size || '-',
                    color: itemEl.dataset.color || '-',
                    qty: parseInt(itemEl.dataset.qty || '0', 10),
                    price: parseInt(itemEl.dataset.price || '0', 10),
                }));
            };

            const getSelectedTotal = (selectedItems) => {
                return selectedItems.reduce((sum, itemEl) => {
                    const price = parseInt(itemEl.dataset.price || '0', 10);
                    const qty = parseInt(itemEl.dataset.qty || '0', 10);
                    return sum + (price * qty);
                }, 0);
            };

            const logOrderInBackground = (items, total) => {
                const logUrl = cartCheckoutLink?.dataset.logUrl;
                const csrfToken = cartCheckoutLink?.dataset.csrf;

                if (!logUrl || !csrfToken) {
                    return;
                }

                const payload = JSON.stringify({
                    _token: csrfToken,
                    items,
                    total,
                });

                // Prefer sendBeacon so order logging survives page navigation.
                if (navigator.sendBeacon) {
                    const beaconBody = new Blob([payload], { type: 'application/json' });
                    const queued = navigator.sendBeacon(logUrl, beaconBody);

                    if (queued) {
                        return;
                    }
                }

                fetch(logUrl, {
                    method: 'POST',
                    keepalive: true,
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: payload,
                }).catch((error) => {
                    console.error('Gagal mencatat pesanan:', error);
                });
            };

            const updateCartCheckoutSummary = () => {
                if (!cartCheckoutLink || !cartItemCheckboxes.length) return;

                const selectedItems = getSelectedItemElements();
                const selectedTotal = getSelectedTotal(selectedItems);

                if (cartSelectedTotal) {
                    cartSelectedTotal.textContent = formatRupiah(selectedTotal);
                }

                if (cartSelectedCount) {
                    cartSelectedCount.textContent = String(selectedItems.length);
                }

                if (cartSelectAll) {
                    cartSelectAll.checked = selectedItems.length === cartItemCheckboxes.length;
                    cartSelectAll.indeterminate = selectedItems.length > 0 && selectedItems.length < cartItemCheckboxes.length;
                }

                if (!selectedItems.length) {
                    cartCheckoutLink.href = '#';
                    cartCheckoutLink.classList.add('opacity-50', 'pointer-events-none');
                    cartCheckoutLink.setAttribute('aria-disabled', 'true');
                    if (cartEmptySelection) {
                        cartEmptySelection.classList.remove('hidden');
                    }
                    return;
                }

                const pesanLines = ['Halo kak, saya mau pesan:'];

                selectedItems.forEach((itemEl) => {
                    const name = itemEl.dataset.name || 'Produk';
                    const size = itemEl.dataset.size || '-';
                    const color = itemEl.dataset.color || '-';
                    const qty = parseInt(itemEl.dataset.qty || '0', 10);
                    const price = parseInt(itemEl.dataset.price || '0', 10);
                    const lineTotal = price * qty;

                    pesanLines.push('- ' + name + ' (' + size + ', ' + color + ') x' + qty + ' = Rp ' + lineTotal.toLocaleString('id-ID'));
                });

                pesanLines.push('Total: Rp ' + selectedTotal.toLocaleString('id-ID'));
                pesanLines.push('Mohon konfirmasi ketersediaan dan ongkir.');

                const waBase = cartCheckoutLink.dataset.waBase || '';
                cartCheckoutLink.href = waBase + '?text=' + encodeURIComponent(pesanLines.join('\n'));
                cartCheckoutLink.classList.remove('opacity-50', 'pointer-events-none');
                cartCheckoutLink.removeAttribute('aria-disabled');

                if (cartEmptySelection) {
                    cartEmptySelection.classList.add('hidden');
                }
            };

            if (cartCheckoutLink) {
                cartCheckoutLink.addEventListener('click', (event) => {
                    const selectedItems = getSelectedItemElements();

                    if (!selectedItems.length) {
                        event.preventDefault();
                        if (cartEmptySelection) {
                            cartEmptySelection.classList.remove('hidden');
                        }
                        return;
                    }

                    const payloadItems = buildSelectedOrderPayload(selectedItems);
                    const payloadTotal = payloadItems.reduce((sum, item) => sum + (item.qty * item.price), 0);

                    // Do not block navigation to WhatsApp.
                    logOrderInBackground(payloadItems, payloadTotal);
                });
            }

            if (cartSelectAll && cartItemCheckboxes.length) {
                cartSelectAll.addEventListener('change', () => {
                    cartItemCheckboxes.forEach((checkbox) => {
                        checkbox.checked = cartSelectAll.checked;
                    });
                    updateCartCheckoutSummary();
                });
            }

            if (cartItemCheckboxes.length) {
                cartItemCheckboxes.forEach((checkbox) => {
                    checkbox.addEventListener('change', updateCartCheckoutSummary);
                });
                updateCartCheckoutSummary();
            }
        });
    </script>
</body>
</html>
