<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Kategori -->
        <div class="mb-8 bg-[#fffaf0] p-4 rounded-xl border border-yellow-100 shadow">
            <h3 class="text-lg font-semibold text-gray-700 mb-3">Kategori Roti</h3>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('produk.index') }}"
                   class="px-4 py-2 rounded-full font-medium transition
                   {{ request()->routeIs('produk.index') ? 'bg-amber-500 text-white shadow hover:bg-amber-600' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                    Semua
                </a>
                @foreach($kategoris as $kategori)
                    <a href="{{ route('produk.kategori', $kategori->id) }}"
                       class="px-4 py-2 rounded-full font-medium transition
                       {{ $kategori->id == $kategoriAktif->id ? 'bg-amber-500 text-white shadow hover:bg-amber-600' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        {{ $kategori->nama_kategori }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Daftar Produk -->
        @if($produks->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($produks as $produk)
                    <div class="relative bg-[#fffdf5] rounded-xl shadow-md overflow-hidden flex flex-col group transition duration-300 hover:shadow-xl">

                        <!-- Gambar -->
                        <a href="{{ route('produk.show', $produk->id) }}">
                            <img src="{{ asset('storage/' . $produk->gambar) }}" 
                                 alt="{{ $produk->nama_produk }}"
                                 class="w-full h-48 object-cover group-hover:scale-105 transition duration-300" />
                        </a>

                        <!-- Badge stok -->
                        @if($produk->stok == 0)
                            <span class="absolute top-2 left-2 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded shadow">
                                Stok Habis
                            </span>
                        @elseif($produk->stok <= 5)
                            <span class="absolute top-2 left-2 bg-yellow-400 text-white text-xs font-semibold px-2 py-1 rounded shadow">
                                Stok Hampir Habis
                            </span>
                        @endif

                        <!-- Konten -->
                        <div class="p-4 flex flex-col flex-grow">
                            <a href="{{ route('produk.show', $produk->id) }}">
                                <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-amber-500 transition">
                                    {{ $produk->nama_produk }}
                                </h3>
                            </a>
                            <p class="text-sm text-gray-500 italic mb-1">
                                {{ $produk->kategori->nama_kategori ?? '-' }}
                            </p>
                            <p class="text-amber-600 font-bold text-base mb-1">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </p>
                            <p class="text-sm text-gray-500 mb-3">Stok: {{ $produk->stok }}</p>

                            <div class="flex justify-between items-center mt-auto">
                                <a href="{{ route('produk.show', $produk->id) }}" 
                                   class="text-amber-500 hover:text-amber-700 text-sm font-medium">
                                    Detail →
                                </a>
                                @if($produk->stok > 0)
                                    <a href="{{ route('produk.show', $produk->id) }}#order" 
                                       class="text-sm bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600 transition">
                                        Pesan
                                    </a>
                                @else
                                    <span class="text-sm bg-gray-300 text-white px-3 py-1 rounded cursor-not-allowed">
                                        Kosong
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $produks->links() }}
            </div>
        @else
            <div class="bg-white p-8 rounded-lg shadow text-center">
                <p class="text-gray-500">Tidak ada produk yang ditemukan dalam kategori ini.</p>
            </div>
        @endif
    </div>
</x-app-layout>
