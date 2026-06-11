@extends('layouts.admin')

@section('title', 'Pesan Kontak')

@section('content')
<div class="mb-6">
    <p class="text-gray-500">Daftar pesan masuk dari formulir kontak landing page.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-100">
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Nama</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Email</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Tanggal</th>
                <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($contacts as $contact)
                <tr class="hover:bg-slate-50 transition-colors {{ !$contact->is_read ? 'font-bold bg-orange-50/30' : '' }}">
                    <td class="px-6 py-4">
                        @if(!$contact->is_read)
                            <span class="flex h-2 w-2 rounded-full bg-orange-500"></span>
                        @else
                            <span class="flex h-2 w-2 rounded-full bg-gray-300"></span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800">{{ $contact->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $contact->email }}</td>
                    <td class="px-6 py-4 text-gray-400 text-xs">{{ $contact->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all" title="Baca Pesan">
                            <i class="fas fa-eye text-xs"></i>
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pesan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-all" title="Hapus">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-20 text-center text-gray-400">Belum ada pesan masuk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if($contacts->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            {{ $contacts->links() }}
        </div>
    @endif
</div>
@endsection
