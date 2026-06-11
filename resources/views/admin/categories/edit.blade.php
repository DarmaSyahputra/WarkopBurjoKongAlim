@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-500 hover:text-orange-500 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" name="name" id="name" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all @error('name') border-rose-500 @enderror" placeholder="Contoh: Kopi, Makanan Berat" value="{{ old('name', $category->name) }}">
                @error('name')
                    <p class="text-rose-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 rounded-xl font-semibold text-gray-500 hover:bg-gray-50 transition-colors">Batal</a>
                <button type="submit" class="px-8 py-3 bg-orange-500 text-white rounded-xl font-bold shadow-sm shadow-orange-200 hover:bg-orange-600 transition-all">Perbarui Kategori</button>
            </div>
        </form>
    </div>
</div>
@endsection
