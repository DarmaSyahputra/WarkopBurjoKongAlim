@extends('layouts.admin')

@section('title', 'Ubah Password')

@section('content')
<div class="max-w-xl">
    <div class="mb-6">
        <p class="text-gray-500">Amankan akun administrator Anda dengan memperbarui kata sandi secara berkala.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form action="{{ route('admin.password.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password" 
                            class="w-full pl-4 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('current_password', 'current_password_icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-orange-500 transition-colors">
                            <i id="current_password_icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center"><i class="fas fa-exclamation-circle mr-1.5"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" 
                            class="w-full pl-4 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password', 'password_icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-orange-500 transition-colors">
                            <i id="password_icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center"><i class="fas fa-exclamation-circle mr-1.5"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            class="w-full pl-4 pr-12 py-3.5 rounded-xl border border-gray-200 focus:border-orange-500 focus:ring-2 focus:ring-orange-200 outline-none transition-all"
                            placeholder="••••••••">
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', 'password_confirmation_icon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-orange-500 transition-colors">
                            <i id="password_confirmation_icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t flex justify-end">
                <button type="submit" class="px-8 py-3.5 bg-orange-500 text-white rounded-xl font-bold shadow-lg shadow-orange-100 hover:bg-orange-600 hover:-translate-y-0.5 transition-all">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
@endsection
