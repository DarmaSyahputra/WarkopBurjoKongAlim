@extends('layouts.admin')

@section('title', 'Manajemen Menu Warkop')

@section('content')
<div class="mb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
    <div class="flex-1 w-full md:max-w-md">
        <form action="{{ route('admin.menus.index') }}" method="GET" class="flex gap-2">
            <div class="relative flex-1">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" placeholder="Cari nama menu..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none" value="{{ request('search') }}">
            </div>
            <select name="category" onchange="this.form.submit()" class="px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </form>
    </div>
    <a href="{{ route('admin.menus.create') }}" class="px-5 py-2.5 bg-orange-500 text-white rounded-xl font-semibold shadow-sm shadow-orange-200 hover:bg-orange-600 transition-all flex items-center">
        <i class="fas fa-plus mr-2"></i> Tambah Menu
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden text-sm">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Gambar</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Menu</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Kategori</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Harga</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($menus as $menu)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="w-12 h-12 rounded-lg object-cover border border-gray-100">
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $menu->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $menu->category->name }}</td>
                    <td class="px-6 py-4 font-bold text-gray-700">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        @if($menu->is_available)
                            <span class="px-2 py-1 rounded-md bg-emerald-50 text-emerald-600 text-[10px] font-bold uppercase">Tersedia</span>
                        @else
                            <span class="px-2 py-1 rounded-md bg-rose-50 text-rose-600 text-[10px] font-bold uppercase">Habis</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')">
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
                    <td colspan="6" class="px-6 py-20 text-center text-gray-400">Belum ada menu.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($menus->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $menus->links() }}
        </div>
    @endif
</div>
@endsection
