<x-app-layout>

    <div class="py-8 bg-amber-50 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="text-sm text-gray-500 mb-6">
            </nav>

            @if($items->count() > 0)
                <div class="space-y-6">
                    @foreach($items as $item)
                        <div class="bg-white p-4 rounded-xl shadow-md grid grid-cols-1 md:grid-cols-12 items-center gap-4">
                            <div class="md:col-span-2">
                                <img src="{{ asset('storage/' . $item->produk->gambar) }}" alt="{{ $item->produk->nama_produk }}"
                                     class="w-24 h-24 object-cover rounded-lg transform hover:scale-105 transition duration-300">
                            </div>
                            <div class="md:col-span-4">
                                <h3 class="font-semibold text-gray-900 text-lg">{{ $item->produk->nama_produk }}</h3>
                                <p class="text-sm text-gray-500">{{ $item->produk->kategori->nama_kategori }}</p>
                            </div>
                            <div class="md:col-span-2 text-gray-700 text-center">
                                Rp {{ number_format($item->produk->harga, 0, ',', '.') }}
                            </div>
                            <div class="md:col-span-2 flex justify-center">
                                <div class="flex items-center border rounded-full overflow-hidden shadow-sm">
                                    <form action="{{ route('keranjang.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="jumlah" value="{{ max(1, $item->jumlah - 1) }}">
                                        <button type="submit" class="w-8 h-8 bg-gray-100 text-gray-600 hover:bg-gray-200 flex items-center justify-center"
                                            {{ $item->jumlah <= 1 ? 'disabled' : '' }}>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                            </svg>
                                        </button>
                                    </form>
                                    <span class="px-4 text-sm text-gray-800">{{ $item->jumlah }}</span>
                                    <form action="{{ route('keranjang.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="jumlah" value="{{ $item->jumlah + 1 }}">
                                        <button type="submit" class="w-8 h-8 bg-gray-100 text-gray-600 hover:bg-gray-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="md:col-span-1 text-center text-amber-700 font-semibold">
                                Rp {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}
                            </div>
                            <div class="md:col-span-1 text-right">
                                <form action="{{ route('keranjang.hapus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <!-- Total dan Checkout -->
                    <div class="bg-white p-4 rounded-xl shadow flex justify-between items-center">
                        <div class="text-lg font-bold text-gray-800">
                            Total: <span class="text-amber-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('checkout.metode') }}"
                           class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.3 2.3a1 1 0 0 0 .7 1.7H17m0 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-8 2a2 2 0 1 1-4 0 2 2 0 0 1 4 0z" />
                            </svg>
                            Lanjut ke Pembayaran
                        </a>
                    </div>
                </div>
            @else
                <div class="text-center py-20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-semibold text-gray-900">Keranjang kosong</h3>
                    <p class="mt-1 text-gray-500">Tambahkan produk ke keranjang Anda dan mulai belanja sekarang.</p>
                    <div class="mt-6">
                        <a href="{{ route('produk.index') }}"
                           class="px-4 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition">
                            Belanja Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
