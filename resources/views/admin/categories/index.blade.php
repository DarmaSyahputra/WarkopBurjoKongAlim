@extends('layouts.admin')

@section('title', 'Manajemen Kategori Menu')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <p class="text-gray-500">Kelola kategori untuk mengelompokkan menu warkop.</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 bg-orange-500 text-white rounded-xl font-semibold shadow-sm shadow-orange-200 hover:bg-orange-600 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama Kategori</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Slug</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Total Menu</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($categories as $category)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $category->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $category->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-600 text-xs font-bold">{{ $category->menus_count }} Menu</span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Semua menu dalam kategori ini akan terhapus.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center text-gray-400">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($categories->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $categories->links() }}
        </div>
    @endif
</div>
@endsection
