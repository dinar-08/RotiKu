<x-app-layout>

    <!-- HERO SECTION -->
    <section class="relative min-h-[80vh] flex items-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/bgrnd roti.jpg') }}" alt="Background RotiKu"
                class="w-full h-full object-cover brightness-50">
        </div>
        <div class="container mx-auto px-4 relative z-10">
            <div
                class="max-w-2xl mx-auto text-center p-8 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 shadow-xl">
                <h1 class="text-4xl font-bold text-white mb-6">
                    Selamat Datang di <span class="text-amber-400">RotiKu</span>
                </h1>
                <p class="text-xl text-white/80 mb-8">Roti Segar Setiap Hari Langsung dari Oven Kami</p>
                <a href="{{ route('produk.index') }}"
                    class="inline-block bg-amber-500 text-white px-8 py-3 rounded-lg hover:bg-amber-600 transition-all duration-300 font-semibold shadow-lg">
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>

    <!-- PRODUK TERBARU -->
    <section id="produk" class="py-20 bg-[#f5f5dc]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 inline-block border-b-4 border-amber-400 pb-2">
                    Produk Terbaru
                </h2>
                <p class="text-gray-700 mt-2">Pilihan roti terbaru yang siap menggoda selera Anda</p>
            </div>

            <div class="flex flex-wrap justify-center gap-8">
                @forelse ($produkTerbaru ?? [] as $produk)
                    <div
                        class="w-[300px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col transform hover:-translate-y-1 duration-300">
                        <div class="relative">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                    class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                            @else
                                <div class="h-48 flex items-center justify-center bg-gray-100 text-gray-400">
                                    Tidak ada gambar
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $produk->nama_produk }}</h3>
                            <p class="text-amber-600 font-semibold mb-2">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mb-4">Stok: {{ $produk->stok }}</p>
                            <div class="flex justify-between mt-auto">
                                <a href="#" class="text-blue-500 hover:underline text-sm">Detail</a>
                                <button
                                    class="bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600 transition">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 w-full">Belum ada produk tersedia saat ini.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- PRODUK BEST SELLER -->
    <section class="py-20 bg-[#fff8e1]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800 inline-block border-b-4 border-amber-500 pb-2">
                    Produk Best Seller
                </h2>
                <p class="text-gray-700 mt-2">Produk yang paling laris dan banyak diminati pelanggan</p>
            </div>

            <div class="flex flex-wrap justify-center gap-8">
                @forelse ($produkBestSeller ?? [] as $produk)
                    <div
                        class="w-[300px] bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col transform hover:-translate-y-1 duration-300">
                        <div class="relative">
                            @if ($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                    class="w-full h-48 object-cover hover:scale-105 transition duration-300">
                            @else
                                <div class="h-48 flex items-center justify-center bg-gray-100 text-gray-400">
                                    Tidak ada gambar
                                </div>
                            @endif
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="font-semibold text-lg text-gray-800 mb-1">{{ $produk->nama_produk }}</h3>
                            <p class="text-amber-600 font-semibold mb-2">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mb-1">Stok: {{ $produk->stok }}</p>
                            <p class="text-sm text-gray-500 mb-4">Terjual: {{ $produk->total_terjual }} pcs</p>
                            <div class="flex justify-between mt-auto">
                                <a href="#" class="text-blue-500 hover:underline text-sm">Detail</a>
                                <button
                                    class="bg-amber-500 text-white px-3 py-1 rounded text-sm hover:bg-amber-600 transition">
                                    + Keranjang
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-500 w-full">Belum ada produk best seller saat ini.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <section class="py-20 bg-[#f5f5dc]">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2">
                    <img src="{{ asset('images/Logo RotiKu.png') }}" alt="Tentang RotiKu"
                        class="w-full h-auto rounded-xl shadow-lg">
                </div>
                <div class="lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">
                        Tentang <span class="text-amber-500">RotiKu</span>
                    </h2>
                    <p class="text-gray-700 mb-4">
                        Sejak tahun 2010, RotiKu berkomitmen menghadirkan roti berkualitas dengan bahan alami pilihan.
                        Kami percaya bahwa roti bukan hanya makanan, melainkan seni dan kebahagiaan yang bisa dibagikan.
                    </p>
                    <p class="text-gray-700 mb-6">
                        Dari dapur kecil hingga menjadi favorit keluarga, kami terus berkembang dengan cinta dan
                        semangat.
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="bg-amber-50 p-5 rounded-lg text-center shadow">
                            <h4 class="text-2xl font-bold text-amber-600">10+</h4>
                            <p class="text-sm text-gray-600">Tahun Pengalaman</p>
                        </div>
                        <div class="bg-amber-50 p-5 rounded-lg text-center shadow">
                            <h4 class="text-2xl font-bold text-amber-600">50+</h4>
                            <p class="text-sm text-gray-600">Varian Produk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCRIPT UNTUK SCROLLSPY -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const produkSection = document.getElementById('produk');
            const produkNav = document.getElementById('nav-produk');

            function handleScroll() {
                const offsetTop = produkSection.offsetTop - 100;
                const offsetBottom = offsetTop + produkSection.offsetHeight;

                if (window.scrollY >= offsetTop && window.scrollY < offsetBottom) {
                    produkNav.classList.add('text-amber-600', 'font-bold', 'border-b-2', 'border-amber-500');
                } else {
                    produkNav.classList.remove('text-amber-600', 'font-bold', 'border-b-2', 'border-amber-500');
                }
            }

            window.addEventListener('scroll', handleScroll);
            handleScroll(); // trigger on load
        });
    </script>

    <!-- FOOTER -->
    @include('layouts.footer')

</x-app-layout>
