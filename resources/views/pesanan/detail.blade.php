<x-app-layout>
    <div class="py-10 bg-[#fefce8] min-h-screen">
        <div class="max-w-3xl mx-auto bg-white p-6 md:p-10 rounded-xl shadow">

            {{-- Header --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Detail Pesanan</h1>
                <p class="text-sm text-gray-600 mt-1">
                    Pesanan dibuat pada {{ $pesanan->created_at->format('d M Y, H:i') }}
                </p>
            </div>

            {{-- Status Pesanan --}}
            <div class="mb-6">
                @if ($pesanan->status === 'lunas')
                    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
                        Pesanan <strong>selesai</strong> dan dibayar.
                    </div>
                @elseif ($pesanan->status === 'pending')
                    <div class="bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3 rounded">
                        Pesanan <strong>menunggu pembayaran</strong>.
                    </div>
                @else
                    <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                        Status: <strong>{{ ucfirst($pesanan->status) }}</strong>
                    </div>
                @endif
            </div>

            {{-- Informasi Pesanan --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm mb-6">
                <div>
                    <p><strong>Kode Pesanan:</strong> {{ $pesanan->kode }}</p>
                    <p><strong>Metode Pembayaran:</strong> {{ strtoupper($pesanan->metode_pembayaran) }}</p>
                </div>
                <div>
                    <p><strong>Total:</strong> Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($pesanan->status) }}</p>
                </div>
            </div>

            {{-- Daftar Produk --}}
            <div class="space-y-4">
                @foreach ($pesanan->detailPesanan as $item)
                    @if ($item->produk)
                        <div class="border border-gray-200 rounded-lg overflow-hidden flex flex-col md:flex-row">
                            {{-- Gambar --}}
                            <div class="md:w-32 w-full h-32 bg-gray-100 flex-shrink-0">
                                <img src="{{ asset('storage/' . ($item->produk->gambar ?? 'default.png')) }}"
                                     alt="{{ $item->produk->nama_produk }}"
                                     class="w-full h-full object-cover">
                            </div>

                            {{-- Info Produk --}}
                            <div class="flex-1 p-4 space-y-1">
                                <h2 class="font-semibold text-gray-800">{{ $item->produk->nama_produk }}</h2>
                                <p class="text-gray-600 text-sm">
                                    {{ $item->produk->kategori->nama_kategori ?? '-' }}
                                </p>
                                <div class="text-sm text-gray-700">
                                    <p>Harga: Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    <p>Jumlah: {{ $item->jumlah }}</p>
                                    <p>Subtotal: Rp{{ number_format($item->harga_satuan * $item->jumlah, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- Total --}}
            <div class="mt-6 border-t pt-4 text-right text-lg font-bold text-gray-800">
                Total Pembayaran: Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
            </div>

            {{-- Tombol Kembali --}}
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}"
                   class="inline-block bg-amber-500 hover:bg-amber-600 text-white font-semibold py-2 px-6 rounded-lg transition">
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
