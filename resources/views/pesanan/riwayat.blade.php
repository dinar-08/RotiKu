<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Pesanan Saya</h1>

        <!-- Filter Tabs -->
        @php
            $statusList = [
                'semua' => 'Semua',
                'menunggu' => 'Belum Dibayar',
                'berhasil' => 'Selesai',
                'dibatalkan' => 'Dibatalkan'
            ];
            $current = request()->query('status', 'semua');
        @endphp

        <div class="flex space-x-6 mb-6 border-b border-gray-300">
            @foreach ($statusList as $key => $label)
                <a href="{{ route('pesanan.riwayat', ['status' => $key]) }}"
                   class="pb-2 text-sm font-semibold border-b-2 transition
                          {{ $current == $key ? 'text-amber-600 border-amber-500' : 'text-gray-500 border-transparent hover:text-amber-600' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <!-- Daftar Pesanan -->
        @forelse ($pesanans as $pesanan)
            <div class="bg-white shadow rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center border-b pb-2 mb-4">
                    <span class="text-sm text-gray-600 font-medium">#{{ $pesanan->kode_pesanan }}</span>
                    <span class="text-sm font-semibold capitalize text-amber-600">
                        Pesanan {{ ucfirst($pesanan->status) }}
                    </span>
                </div>

                @foreach ($pesanan->detailPesanan as $item)
                    @if ($item->produk)
                        <div class="flex items-center space-x-4 mb-4">
                            <img src="{{ $item->produk->gambar 
                                    ? asset('storage/' . $item->produk->gambar) 
                                    : asset('images/default.png') }}"
                                 alt="{{ $item->produk->nama_produk }}"
                                 class="w-16 h-16 object-cover rounded border">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-800">
                                    {{ $item->produk->nama_produk }}
                                </p>
                                <p class="text-xs text-gray-500">x{{ $item->jumlah }}</p>
                                <p class="text-sm text-gray-700 font-semibold mt-1">
                                    Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="flex justify-between items-center mt-2 border-t pt-3">
                    <div></div>
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Total:</p>
                        <p class="text-lg font-bold text-gray-800">
                            Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-2">
                    <a href="{{ route('pesanan.detail', $pesanan->id) }}"
                       class="bg-amber-500 text-white text-sm px-4 py-2 rounded hover:bg-amber-600">
                        Lihat Detail
                    </a>
                    <a href="{{ route('produk.index') }}"
                       class="text-amber-500 border border-amber-500 text-sm px-4 py-2 rounded hover:bg-amber-100">
                        Beli Lagi
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">Belum ada pesanan.</p>
        @endforelse
    </div>
</x-app-layout>
