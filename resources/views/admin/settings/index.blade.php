@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
<div class="mb-6">
    <p class="text-gray-500">Sesuaikan informasi yang tampil pada landing page.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            @foreach($settings as $setting)
                <div>
                    <label for="setting_{{ $setting->key }}" class="block text-sm font-bold text-gray-700 mb-2">{{ $setting->label }}</label>
                    @if($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" id="setting_{{ $setting->key }}" rows="3" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all">{{ $setting->value }}</textarea>
                    @else
                        <input type="text" name="settings[{{ $setting->key }}]" id="setting_{{ $setting->key }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all" value="{{ $setting->value }}">
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-10 pt-6 border-t flex justify-end">
            <button type="submit" class="px-10 py-4 bg-orange-500 text-white rounded-xl font-bold shadow-lg shadow-orange-200 hover:bg-orange-600 hover:-translate-y-0.5 transition-all">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
