<header class="bg-gradient-to-r from-orange-400 to-amber-400 shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <div
                    class="rounded-full overflow-hidden border-2 border-white w-12 h-12 flex items-center justify-center bg-white/10 backdrop-blur-sm">
                    <img src="{{ asset('images/logorotiku.png') }}" class="h-16 w-16 object-contain" alt="Logo RotiKu">
                </div>
                <div class="ml-3">
                    <h1 class="text-xl font-bold text-white">RotiKu</h1>
                    <p class="text-xs text-white/80">Fresh From The Oven</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-8 items-center">
                <a href="{{ route('home') }}"
                    class="text-white font-medium pb-1 {{ request()->routeIs('home') ? 'border-b-2 border-white' : 'hover:text-white text-white/90' }}">
                    Beranda
                </a>

                <a href="{{ route('produk.index') }}"
                    class="text-white font-medium pb-1 {{ request()->routeIs('produk.index') ? 'border-b-2 border-white' : 'hover:text-white text-white/90' }}">
                    Produk
                </a>

                <a href="{{ route('produk.kategori', ['id' => 1]) }}"
                    class="text-white font-medium pb-1 {{ request()->routeIs('produk.kategori') ? 'border-b-2 border-white' : 'hover:text-white text-white/90' }}">
                    Kategori
                </a>

                <a href="{{ route('pesanan.riwayat') }}"
                    class="text-white font-medium pb-1 {{ request()->routeIs('pesanan.riwayat') ? 'border-b-2 border-white' : 'hover:text-white text-white/90' }}">
                    Pesanan Saya
                </a>

                <!-- Keranjang -->
                <a href="{{ route('keranjang.index') }}" class="text-white/90 hover:text-white transition relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    @auth
                        <span
                            class="absolute -top-2 -right-2 bg-white text-amber-600 text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">
                            {{ auth()->user()->keranjang()->count() ?? 0 }}
                        </span>
                    @else
                        <span
                            class="absolute -top-2 -right-2 bg-white text-amber-600 text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">0</span>
                    @endauth
                </a>

                <!-- Auth Section -->
                @auth
                    <!-- Profile Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-1 focus:outline-none">
                            <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.show') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50">
                                Profil Saya
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-amber-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="bg-white text-amber-600 px-4 py-2 rounded-lg hover:bg-white/90 transition font-medium">
                        Login
                    </a>
                @endauth
            </nav>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>
</header>