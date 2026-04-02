<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tito Shoes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans flex h-screen overflow-hidden text-slate-900">

    <!-- Desktop Sidebar -->
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
            <a href="/admin" class="flex items-center gap-3 px-4 py-3 bg-[#3CB043]/5 text-[#3CB043] rounded-xl transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-[#3CB043] text-white shadow-sm shadow-[#3CB043]/20">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <span class="font-bold">Katalog Sepatu</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="flex items-center gap-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-slate-800 rounded-xl transition-all duration-200 group">
                <div class="p-2 rounded-lg bg-slate-100 text-slate-400 group-hover:bg-white group-hover:text-slate-800 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                </div>
                <span class="font-medium">Pesanan</span>
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
            
            <div class="hidden md:flex items-center bg-slate-100 rounded-xl px-4 py-2 w-96">
                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" placeholder="Cari sesuatu..." class="bg-transparent border-none focus:ring-0 text-sm ml-2 w-full">
            </div>

            <div class="flex items-center gap-6">
                <div class="relative hidden sm:block">
                    <div class="absolute -top-1 -right-1 w-2 h-2 bg-red-500 rounded-full animate-pulse"></div>
                    <svg class="w-6 h-6 text-slate-400 hover:text-slate-600 cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800 leading-none">Admin Utama</p>
                        <p class="text-[11px] text-slate-400 font-medium mt-1">Super Admin</p>
                    </div>
                    <div class="w-11 h-11 bg-gradient-to-tr from-[#3CB043] to-green-400 rounded-xl flex items-center justify-center text-white font-black text-lg shadow-sm border-2 border-white">A</div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-4 lg:p-8">
            <div class="max-w-7xl mx-auto">
                @if(session('success'))
                    <div class="mb-8 flex items-center gap-3 bg-green-50 border border-green-100 text-[#3CB043] px-6 py-4 rounded-2xl shadow-sm animate-fade-in">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold tracking-tight">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                    <div>
                        <h2 class="text-3xl font-black text-slate-800 tracking-tight">Katalog Produk</h2>
                        <p class="text-slate-500 mt-2 font-medium">Kelola dan update inventaris sepatu modern Anda secara real-time.</p>
                    </div>
                    <a href="{{ route('shoes.create') }}" class="group bg-[#3CB043] hover:bg-[#34993a] text-white px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-[#3CB043]/20 transition-all duration-300 flex items-center gap-3 hover:-translate-y-1">
                        <div class="bg-white/20 p-1.5 rounded-lg group-hover:bg-white/30 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        Tambah Sepatu Baru
                    </a>
                </div>

                <!-- Stats Summary -->
                @php
                    $latestShoe = $shoes->sortByDesc('created_at')->first();
                @endphp
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                        <div class="absolute right-0 bottom-0 w-24 h-24 bg-green-50 rounded-tl-full -mr-8 -mb-8 transition-transform group-hover:scale-110"></div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-1">Total Produk</p>
                        <h3 class="text-4xl font-black text-slate-800">{{ count($shoes) }}</h3>
                        <p class="text-xs text-green-600 font-bold mt-2 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z"></path></svg>
                            Inventaris aktif
                        </p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-shadow group relative overflow-hidden">
                        <div class="absolute right-0 bottom-0 w-24 h-24 bg-blue-50 rounded-tl-full -mr-8 -mb-8 transition-transform group-hover:scale-110"></div>
                        <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mb-1">Produk Terbaru</p>
                        <h3 class="text-2xl font-black text-slate-800">
                            {{ $latestShoe ? $latestShoe->name : 'Belum ada produk' }}
                        </h3>
                        <p class="text-xs text-blue-600 font-bold mt-2">
                            {{ $latestShoe && $latestShoe->created_at ? $latestShoe->created_at->format('d M Y') : '—' }}
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden mb-12">
                    <div class="px-8 py-6 border-b border-slate-50 flex items-center justify-between">
                        <h4 class="font-bold text-slate-800">Daftar Inventaris</h4>
                        <div class="flex gap-2">
                             <button class="p-2.5 bg-slate-50 text-slate-400 rounded-xl hover:text-slate-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                             </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-slate-400 text-[11px] font-black uppercase tracking-[0.2em]">
                                    <th class="px-8 py-6 font-medium">Visual</th>
                                    <th class="px-8 py-6 font-medium">Informasi Produk</th>
                                    <th class="px-8 py-6 font-medium">Label Harga</th>
                                    <th class="px-8 py-6 font-medium text-right">Manajemen</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($shoes as $shoe)
                                <tr class="hover:bg-slate-50/80 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="w-20 h-20 rounded-2xl bg-slate-50 border border-slate-100 overflow-hidden flex items-center justify-center p-2 group-hover:scale-105 transition-transform">
                                            @if(Str::startsWith($shoe->image, 'http') || Str::startsWith($shoe->image, 'images/'))
                                                <img src="{{ Str::startsWith($shoe->image, 'http') ? $shoe->image : asset($shoe->image) }}" alt="{{ $shoe->name }}" class="w-full h-full object-contain drop-shadow-md">
                                            @else
                                                <img src="{{ Storage::url($shoe->image) }}" alt="{{ $shoe->name }}" class="w-full h-full object-contain drop-shadow-md">
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <h5 class="font-black text-slate-800 text-lg leading-tight">{{ $shoe->name }}</h5>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="px-2 py-0.5 bg-slate-100 text-slate-400 text-[10px] font-black rounded uppercase">Stock Ready</span>
                                            <span class="text-slate-400 text-xs truncate max-w-[200px]">{{ $shoe->description ?? 'Tidak ada deskripsi' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="inline-flex flex-col">
                                            <span class="text-xs font-bold text-slate-400 mb-0.5">Price Tag</span>
                                            <span class="text-slate-900 font-extrabold text-xl">Rp {{ number_format($shoe->price, 0, ',', '.') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('shoes.edit', $shoe->id) }}" class="flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2.5 rounded-xl font-bold transition-all hover:bg-blue-600 hover:text-white active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-blue-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="{{ route('shoes.destroy', $shoe->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex items-center gap-2 bg-red-50 text-red-500 px-4 py-2.5 rounded-xl font-bold transition-all hover:bg-red-500 hover:text-white active:scale-95 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-red-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-8 py-6 bg-slate-50/50 border-t border-slate-50 flex items-center justify-between">
                         <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest leading-none">Menampilkan {{ count($shoes) }} Model Terkini</p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>