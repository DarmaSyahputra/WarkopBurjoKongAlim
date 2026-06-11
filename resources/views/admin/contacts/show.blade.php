@extends('layouts.admin')

@section('title', 'Detail Pesan Masuk')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-gray-500 hover:text-orange-500 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Pesan
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8 border-b border-gray-100 bg-gray-50/50">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $contact->name }}</h3>
                    <p class="text-sm text-gray-500 mt-1">Dikirim pada {{ $contact->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
                <div>
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-5 py-2.5 bg-rose-50 text-rose-600 font-semibold rounded-xl hover:bg-rose-600 hover:text-white transition-all flex items-center gap-2">
                            <i class="fas fa-trash text-sm"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Email Pengirim</span>
                    <a href="mailto:{{ $contact->email }}" class="text-orange-600 hover:underline font-semibold">{{ $contact->email }}</a>
                </div>
                <div>
                    <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nomor Telepon / WhatsApp</span>
                    @if($contact->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="text-gray-800 font-semibold hover:text-orange-600 hover:underline">
                            {{ $contact->phone }} <span class="text-xs text-emerald-600 ml-1 font-normal">(Hubungi via WA)</span>
                        </a>
                    @else
                        <span class="text-gray-400 italic">Tidak ada nomor telepon</span>
                    @endif
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100">
                <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Isi Pesan</span>
                <div class="bg-gray-50 rounded-2xl p-6 text-gray-700 leading-relaxed whitespace-pre-line border border-gray-100">
                    {{ $contact->message }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
