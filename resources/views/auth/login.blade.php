<x-guest-layout>
    <!-- Logo -->
    <div class="mb-10 text-center">
           <img src="{{ asset('images/Logo RotiKu.png') }}" alt="Logo RotiKu" class="w-40 h-40 mx-auto object-contain">
        <h2 class="text-3xl font-bold text-gray-800 mt-6">Masuk Akun</h2>
        <p class="text-gray-600 mt-2">Silakan masuk dengan akun Anda</p>
    </div>

    <!-- Form Login -->
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf
        
        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
            <input 
                type="email" 
                name="email" 
                required
                autofocus
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="Masukkan Email"
            >
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
            <input 
                type="password" 
                name="password" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-rotiku-utama focus:border-transparent transition duration-200"
                placeholder="Masukkan Password"
            >
        </div>

        <!-- Remember & Forgot -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" class="rounded text-rotiku-utama focus:ring-rotiku-utama">
                <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
            </div>
            <a href="{{ route('password.request') }}" class="text-sm text-amber-600 hover:underline">Lupa password?</a>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-rotiku-utama hover:bg-brown-800 text-white py-3.5 rounded-lg font-medium transition duration-300 shadow-md transform hover:scale-[1.02]">
            Masuk
        </button>
    </form>

    <!-- Register Link -->
    <div class="mt-8 pt-6 border-t border-gray-200 text-center text-sm text-gray-600">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="text-amber-600 hover:underline font-medium">Daftar disini</a>
    </div>
</x-guest-layout>