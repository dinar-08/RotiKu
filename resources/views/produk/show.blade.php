<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Produk') }}
            </h2>
            <a href="{{ url()->previous() }}" class="text-amber-600 hover:text-amber-700 transition font-medium">
                ← Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-10 bg-[#fffaf0] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
                <div class="md:flex gap-8">
                    
                    {{-- Gambar Produk --}}
                    <div class="md:w-1/2 mb-6 md:mb-0 flex justify-center items-center">
                        <div class="bg-gray-100 rounded-lg overflow-hidden h-[400px] w-full flex items-center justify-center">
                            @if($produk->gambar)
                                <img src="{{ asset('storage/' . $produk->gambar) }}" alt="{{ $produk->nama_produk }}"
                                     class="h-full w-full object-contain" />
                            @else
                                <span class="text-gray-400 text-lg">Tidak ada gambar</span>
                            @endif
                        </div>
                    </div>

                    {{-- Detail Produk --}}
                    <div class="md:w-1/2">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $produk->nama_produk }}</h1>

                        <div class="flex items-center mb-3 space-x-2">
                            <span class="bg-amber-100 text-amber-800 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $produk->kategori->nama_kategori }}
                            </span>
                            <span class="text-sm text-gray-500">Stok: {{ $produk->stok }}</span>
                        </div>

                        <div class="text-2xl font-bold text-amber-600 mb-4">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </div>

                        <p class="text-gray-600 mb-6">{{ $produk->deskripsi }}</p>

                        {{-- Form Pemesanan --}}
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-lg font-semibold text-gray-700 mb-3">Pesan Produk Ini</h3>

                           <form action="{{ route('checkout.langsung') }}" method="POST" class="space-y-4">

                                @csrf
                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                <input type="hidden" name="harga" value="{{ $produk->harga }}">

                                {{-- Nama --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="nama" required
                                           class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" />
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <input type="email" name="email" required
                                           class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" />
                                </div>

                                {{-- Jumlah --}}
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                    <input type="number" name="quantity" value="1" min="1"
                                           max="{{ $produk->stok > 0 ? $produk->stok : 100 }}"
                                           {{ $produk->stok <= 0 ? 'disabled' : '' }}
                                           class="mt-1 w-24 px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500" />
                                    @if($produk->stok <= 0)
                                        <p class="text-red-600 text-sm mt-1">Stok habis</p>
                                    @endif
                                </div>

                                {{-- Metode Pembayaran --}}
                                {{-- Metode Pembayaran --}}
<div>
    <label class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
    <select name="metode_pembayaran" required
            class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-amber-500 focus:border-amber-500">
        <option value="">Pilih Metode</option>
        <option value="mandiri_va">Virtual Account Mandiri</option>
        <option value="Tunai">Tunai</option>
    </select>
</div>


                                {{-- Tombol Submit --}}
                                <button type="submit"
                                        class="w-full bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-4 rounded-lg transition">
                                    Pesan Sekarang
                                </button>
                            </form>

                            {{-- Tambah ke Keranjang --}}
                            <form action="{{ route('keranjang.tambah', ['produk' => $produk->id]) }}" method="POST" class="mt-4">
                                @csrf
                                <input type="hidden" name="jumlah" value="1">
                                <button type="submit"
                                        class="w-full border border-amber-500 text-amber-600 hover:bg-amber-50 font-semibold py-2 px-4 rounded-lg transition">
                                    + Tambah ke Keranjang
                                </button>
                            </form>

                            {{-- Notifikasi Guest --}}
                            @guest
                                <div class="mt-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                                    <p class="text-sm text-yellow-700">
                                        Untuk fitur lengkap seperti riwayat pesanan, silakan
                                        <a href="{{ route('login') }}" class="text-amber-600 hover:underline">login</a> atau
                                        <a href="{{ route('register') }}" class="text-amber-600 hover:underline">daftar</a>.
                                    </p>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>

                {{-- Produk Terkait --}}
                @if($produkTerkaits->count())
                    <div class="mt-12 border-t border-gray-200 pt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-6">Produk Terkait</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($produkTerkaits as $produkTerkait)
                                <a href="{{ route('produk.show', $produkTerkait->id) }}" class="group">
                                    <div class="bg-white border rounded-lg overflow-hidden hover:shadow-md transition">
                                        <div class="h-40 bg-gray-100 overflow-hidden">
                                            @if($produkTerkait->gambar)
                                                <img src="{{ asset('storage/' . $produkTerkait->gambar) }}"
                                                     alt="{{ $produkTerkait->nama_produk }}"
                                                     class="w-full h-full object-cover" />
                                            @else
                                                <div class="h-full w-full flex items-center justify-center text-gray-400 text-xs">
                                                    Tidak ada gambar
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-3">
                                            <h4 class="text-sm font-medium text-gray-800 group-hover:text-amber-600">
                                                {{ $produkTerkait->nama_produk }}
                                            </h4>
                                            <p class="text-sm text-amber-600">
                                                Rp {{ number_format($produkTerkait->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
