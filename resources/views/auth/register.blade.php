<x-guest-layout>
    <h2 class="text-3xl font-bold text-gray-800 text-center">Daftar Akun Baru</h2>
    <p class="text-gray-600 mt-2 text-center mb-8">Buat akun untuk mulai berbelanja</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input
                type="text"
                name="name"
                required
                autofocus
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="Nama Anda"
                value="{{ old('name') }}"
            >
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input
                type="email"
                name="email"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="email@contoh.com"
                value="{{ old('email') }}"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input
                type="password"
                name="password"
                required
                autocomplete="new-password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="Minimal 8 karakter"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="Ketik ulang password"
            >
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-rotiku-utama hover:bg-brown-800 text-white py-3.5 rounded-lg font-medium transition duration-300 shadow-md transform hover:scale-[1.02]">
            Daftar Sekarang
        </button>
    </form>

    <!-- Login Link -->
    <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-600">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="text-amber-600 hover:underline font-medium">Masuk disini</a>
    </div>
</x-guest-layout>