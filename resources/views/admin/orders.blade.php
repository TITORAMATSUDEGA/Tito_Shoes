<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Pemesanan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans flex h-screen overflow-hidden text-slate-900">

    <aside class="w-72 bg-white border-r border-slate-200 flex flex-col hidden lg:flex">
        <div class="h-20 flex items-center px-8 border-b border-slate-100 mb-4">
            <h1 class="text-2xl font-black tracking-tight text-slate-800">
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-[#3CB043] text-white mr-2 shadow-sm">👟</span>
                Tito<span class="text-[#3CB043]">Shoes</span>
            </h1>
        </div>

        <div class="px-4 py-4 uppercase text-[11px] font-bold text-slate-400 tracking-widest px-8">Menu Utama</div>
        <nav class="flex-1 px-4 space-y-1">
            <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-slate-100 text-slate-400 group-hover:bg-white group-hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                </div>
                <span class="font-medium">Dashboard</span>
            </a>
            <a href="{{ route('admin') }}" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-slate-100 text-slate-400 group-hover:bg-white group-hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="font-medium">Katalog Sepatu</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 bg-[#3CB043]/5 text-[#3CB043] rounded-xl transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-[#3CB043] text-white shadow-sm shadow-[#3CB043]/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="font-bold">Pemesanan</span>
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-20 bg-white border-b border-slate-200 flex items-center justify-between px-8 z-10 shrink-0">
            <div class="flex items-center gap-4 lg:hidden">
                <button class="p-2 text-slate-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
                <h1 class="text-xl font-bold">TitoShoes</h1>
            </div>

            <h2 class="hidden md:block text-2xl font-black text-slate-800 tracking-tight">Daftar Pemesanan</h2>

            <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-slate-800 leading-none">Admin Utama</p>
                    <p class="text-[11px] text-slate-400 font-medium mt-1">Super Admin</p>
                </div>
                <div class="w-11 h-11 bg-gradient-to-tr from-[#3CB043] to-green-400 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-sm border-2 border-white">A</div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 lg:p-8">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8">
                    <h3 class="text-3xl font-black text-slate-800 tracking-tight">Riwayat Pesanan</h3>
                </div>

                <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 md:px-8 py-5 border-b border-slate-50 flex items-center justify-between">
                        <div>
                            <h4 class="font-bold text-slate-800">Daftar Pesanan</h4>
                            <p class="text-xs text-slate-500 mt-1 font-medium">Pesanan tercatat otomatis saat customer menekan checkout via WhatsApp.</p>
                        </div>
                        <span class="inline-flex items-center rounded-lg bg-[#3CB043]/10 text-[#2f8d3a] px-3 py-1 text-xs font-bold">{{ $orderCollection->count() }} pesanan</span>
                    </div>

                    @if($orderCollection->isEmpty())
                        <div class="px-8 py-16 text-center">
                            <div class="mx-auto w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mb-3 text-slate-400">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2m-6-6l6-6m0 0h-4m4 0v4"></path></svg>
                            </div>
                            <p class="text-slate-700 font-bold">Belum ada pesanan masuk</p>
                            <p class="text-slate-500 text-sm mt-1">Pesanan akan muncul setelah customer menekan tombol Checkout WhatsApp di halaman keranjang.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse min-w-[780px]">
                                <thead>
                                    <tr class="text-slate-400 text-[11px] font-black uppercase tracking-[0.18em]">
                                        <th class="px-6 md:px-8 py-5 font-medium">ID Pesanan</th>
                                        <th class="px-6 md:px-8 py-5 font-medium">Waktu</th>
                                        <th class="px-6 md:px-8 py-5 font-medium">Ringkasan Item</th>
                                        <th class="px-6 md:px-8 py-5 font-medium">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($orderCollection as $order)
                                        @php
                                            $items = collect($order['items'] ?? []);
                                            $previewItems = $items->take(2);
                                        @endphp
                                        <tr class="hover:bg-slate-50/70 transition-colors align-top">
                                            <td class="px-6 md:px-8 py-5">
                                                <p class="font-black text-slate-800">{{ $order['id'] ?? '-' }}</p>
                                                <p class="text-xs text-slate-400 mt-1">{{ $order['channel'] ?? 'WhatsApp' }}</p>
                                            </td>
                                            <td class="px-6 md:px-8 py-5">
                                                <p class="text-sm font-semibold text-slate-700">{{ isset($order['created_at']) ? \Illuminate\Support\Carbon::parse($order['created_at'])->format('d M Y') : '-' }}</p>
                                                <p class="text-xs text-slate-400 mt-1">{{ isset($order['created_at']) ? \Illuminate\Support\Carbon::parse($order['created_at'])->format('H:i') . ' WIB' : '-' }}</p>
                                            </td>
                                            <td class="px-6 md:px-8 py-5">
                                                <p class="text-sm font-semibold text-slate-700">{{ $order['item_count'] ?? $items->count() }} item</p>
                                                <div class="mt-1 text-xs text-slate-500 space-y-1">
                                                    @foreach($previewItems as $preview)
                                                        <p>{{ $preview['name'] ?? 'Produk' }} x{{ $preview['qty'] ?? 0 }}</p>
                                                    @endforeach
                                                    @if($items->count() > 2)
                                                        <p>+{{ $items->count() - 2 }} item lainnya</p>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 md:px-8 py-5">
                                                <p class="text-base font-black text-slate-900">Rp {{ number_format((int) ($order['total'] ?? 0), 0, ',', '.') }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>

</body>
</html>
