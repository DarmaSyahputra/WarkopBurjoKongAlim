@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Menus -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4">
            <i class="fas fa-utensils text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Menu</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_menus'] }}</p>
        </div>
    </div>

    <!-- Total Categories -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mr-4">
            <i class="fas fa-tags text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Kategori</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_categories'] }}</p>
        </div>
    </div>

    <!-- Total Messages -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-12 h-12 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mr-4">
            <i class="fas fa-envelope text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Total Pesan</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_messages'] }}</p>
        </div>
    </div>

    <!-- Unread Messages -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center">
        <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center mr-4">
            <i class="fas fa-bell text-xl"></i>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-500">Pesan Baru</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['unread_messages'] }}</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Chart / Visual placeholder -->
    <div class="lg:col-span-2 bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Statistik Pengunjung (Simulasi)</h3>
        <div class="h-64 bg-slate-50 rounded-xl border border-dashed border-slate-200 flex items-center justify-center">
            <p class="text-slate-400"><i class="fas fa-chart-line mr-2"></i> Grafik kunjungan akan muncul di sini</p>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-bold text-gray-800 mb-6">Pesan Terbaru</h3>
        <div class="space-y-4">
            @forelse($recent_activities as $activity)
                <div class="flex items-start pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                    <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center mr-3 flex-shrink-0">
                        <i class="fas fa-user text-gray-400 text-xs"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold text-gray-800 truncate">{{ $activity->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $activity->message }}</p>
                        <p class="text-[10px] text-gray-400 mt-1 italic">{{ $activity->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400 py-10">Belum ada pesan masuk.</p>
            @endforelse
        </div>
        <div class="mt-6">
            <a href="{{ route('admin.contacts.index') }}" class="block text-center text-sm font-semibold text-orange-500 hover:text-orange-600">Lihat Semua Pesan <i class="fas fa-chevron-right ml-1"></i></a>
        </div>
    </div>
</div>
@endsection
