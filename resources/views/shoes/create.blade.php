<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Tito Shoes</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans min-h-screen flex items-center justify-center p-4 lg:p-8">
    <div class="max-w-2xl w-full bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
        <div class="bg-slate-900 px-8 py-10 text-white relative overflow-hidden">
            <div class="absolute right-0 top-0 w-32 h-32 bg-[#3CB043] rounded-bl-full opacity-20"></div>
            <a href="{{ route('admin') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white transition-colors text-sm font-bold mb-6">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Katalog
            </a>
            <h2 class="text-3xl font-black tracking-tight">Tambah <span class="text-[#3CB043]">Sepatu</span> Baru</h2>
            <p class="text-slate-400 mt-2 font-medium">Lengkapi detail produk untuk dipajang di katalog.</p>
        </div>

        <form action="{{ route('shoes.store') }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-10 space-y-8">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Nama Lengkap Produk</label>
                    <input type="text" name="name" placeholder="Contoh: Nike Air Jordan 1" required class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#3CB043]/10 focus:border-[#3CB043] focus:bg-white outline-none transition-all font-bold text-slate-700">
                </div>
                
                <div class="space-y-2">
                    <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Harga Jual (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">Rp</span>
                        <input type="number" name="price" placeholder="0" required class="w-full pl-12 pr-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#3CB043]/10 focus:border-[#3CB043] focus:bg-white outline-none transition-all font-bold text-slate-700">
                    </div>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Unggah Visual Produk</label>
                <div class="relative group">
                    <input id="image" type="file" name="image" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                    <div id="dropzone" class="w-full px-5 py-8 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl group-hover:bg-slate-100 group-hover:border-[#3CB043] transition-all flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#3CB043] mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <img id="image-preview" alt="Preview gambar" class="hidden w-36 h-36 object-cover rounded-2xl border border-slate-200 mb-3" />
                        <p id="upload-title" class="text-sm font-bold text-slate-600">Klik atau seret gambar ke sini</p>
                        <p id="upload-hint" class="text-xs text-slate-400 mt-1 font-medium">PNG, JPG atau WEBP (Maks. 2MB)</p>
                    </div>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest">Deskripsi Produk</label>
                <textarea name="description" rows="4" placeholder="Ceritakan keunggulan sepatu ini..." class="w-full px-5 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl focus:ring-4 focus:ring-[#3CB043]/10 focus:border-[#3CB043] focus:bg-white outline-none transition-all font-medium text-slate-700"></textarea>
            </div>
            
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 bg-[#3CB043] hover:bg-[#34993a] text-white px-8 py-4 rounded-2xl font-black shadow-lg shadow-[#3CB043]/20 transition-all hover:-translate-y-1">Simpan Katalog</button>
                <a href="{{ route('admin') }}" class="px-8 py-4 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-2xl font-bold transition-all">Batal</a>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const uploadTitle = document.getElementById('upload-title');
        const uploadHint = document.getElementById('upload-hint');

        imageInput.addEventListener('change', (event) => {
            const file = event.target.files && event.target.files[0];
            if (!file) {
                imagePreview.classList.add('hidden');
                uploadTitle.textContent = 'Klik atau seret gambar ke sini';
                uploadHint.textContent = 'PNG, JPG atau WEBP (Maks. 2MB)';
                return;
            }

            imagePreview.src = URL.createObjectURL(file);
            imagePreview.classList.remove('hidden');
            uploadTitle.textContent = file.name;
            uploadHint.textContent = 'Preview sebelum disimpan';
        });
    </script>
</body>
</html>