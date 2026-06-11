@extends('layouts.admin')

@section('title', 'Tambah Menu Baru')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.menus.index') }}" class="text-sm text-gray-500 hover:text-orange-500 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Menu
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Nama Menu -->
                <div class="md:col-span-2">
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Menu</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all" placeholder="Contoh: Indomie Telur Kornet" value="{{ old('name') }}">
                    @error('name') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-2">Kategori</label>
                    <select name="category_id" id="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-bold text-gray-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" id="price" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all" placeholder="Contoh: 12000" value="{{ old('price') }}">
                    @error('price') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all" placeholder="Ceritakan sedikit tentang menu ini...">{{ old('description') }}</textarea>
                    @error('description') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Gambar -->
                <div>
                    <label for="image" class="block text-sm font-bold text-gray-700 mb-2">Gambar Menu</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700 hover:file:bg-orange-100" onchange="previewImage(event)">
                    @error('image') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <div id="image-preview-container" class="mt-4 hidden">
                        <p class="text-xs text-gray-500 mb-2">Preview:</p>
                        <img id="image-preview" src="#" alt="Preview" class="w-32 h-32 object-cover rounded-xl border">
                    </div>
                </div>

                <!-- Status -->
                <div class="flex items-center">
                    <label class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" name="is_available" value="1" class="sr-only" {{ old('is_available', true) ? 'checked' : '' }}>
                            <div class="block bg-gray-200 w-14 h-8 rounded-full"></div>
                            <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                        </div>
                        <div class="ml-3 text-gray-700 font-bold text-sm">Status Tersedia</div>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t">
                <a href="{{ route('admin.menus.index') }}" class="px-6 py-3 rounded-xl font-semibold text-gray-500 hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-8 py-3 bg-orange-500 text-white rounded-xl font-bold shadow-sm shadow-orange-200 hover:bg-orange-600 transition-all">Simpan Menu</button>
            </div>
        </form>
    </div>
</div>

<style>
    input:checked ~ .dot { transform: translateX(100%); background-color: #f97316; }
    input:checked ~ .block { background-color: #ffedd5; }
</style>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('image-preview');
            output.src = reader.result;
            document.getElementById('image-preview-container').classList.remove('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
