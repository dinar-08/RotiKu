<footer class="bg-gray-900 text-white py-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Bagian 1: Tentang -->
            <div>
                <div class="flex items-center mb-4">
                    <div class="rounded-full overflow-hidden border-1 border-white-300 w-15 h-15 flex items-center justify-center bg-gray-800">
                        <img 
                        src="{{ asset('images/logorotiku.png') }}" 
                        class="h-16 w-16 object-contain" 
                        alt="Logo RotiKu"
                        >
                    </div>
                    <span class="ml-3 text-xl font-bold text-gray-100">RotiKu</span>
                </div>
                <p class="text-gray-400">Fresh From The Oven</p>
                <p class="text-gray-400 mt-2">Toko roti dengan bahan premium dan rasa autentik.</p>
            </div>

            <!-- Bagian 2: Kontak -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-gray-100">Kontak Kami</h3>
                <div class="space-y-2">
                    <p class="flex items-center text-gray-400">
                        <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        0812-3456-7890
                    </p>
                    <p class="flex items-center text-gray-400">
                        <svg class="w-5 h-5 mr-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        info@rotiku.com
                    </p>
                </div>
            </div>

            <!-- Bagian 3: Tautan -->
            <div>
                <h3 class="text-xl font-bold mb-4 text-gray-100">Tautan Cepat</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                    <li><a href="{{ route('produk.index') }}" class="text-gray-400 hover:text-white transition">Produk</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Tentang Kami</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition">Kebijakan Privasi</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} RotiKu. All rights reserved.</p>
        </div>
    </div>
</footer>