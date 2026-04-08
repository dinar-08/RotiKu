<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkout Berhasil') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-green-600 mb-4">🎉 Pesanan Berhasil!</h1>
            <p class="text-gray-700 mb-6">
                Kode Pesanan: <span class="font-semibold">{{ $pesanan->kode_pesanan }}</span><br>
                Metode Pembayaran:
                <span class="capitalize">
                    {{ $pesanan->metode_pembayaran === 'mandiri_va' ? 'Virtual Account Mandiri' : $pesanan->metode_pembayaran }}
                </span>
            </p>

            <h2 class="text-lg font-semibold mb-2 text-gray-800">Detail Pesanan</h2>
            <table class="w-full mb-4 text-sm border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 text-left">Produk</th>
                        <th class="border px-3 py-2 text-center">Harga</th>
                        <th class="border px-3 py-2 text-center">Jumlah</th>
                        <th class="border px-3 py-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesanan->detailPesanan as $item)
                        <tr>
                            <td class="border px-3 py-2">{{ $item->produk->nama_produk }}</td>
                            <td class="border px-3 py-2 text-center">Rp
                                {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                            <td class="border px-3 py-2 text-center">{{ $item->jumlah }}</td>
                            <td class="border px-3 py-2 text-right">Rp
                                {{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="border px-3 py-2 font-bold text-right">Total</td>
                        <td class="border px-3 py-2 font-bold text-right text-amber-600">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>

            {{-- Instruksi Pembayaran untuk Mandiri VA --}}
            @if($pesanan->metode_pembayaran === 'mandiri_va' && $pesanan->bill_key && $pesanan->biller_code)
                <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                    <p class="text-gray-700 font-semibold mb-2">Instruksi Pembayaran Virtual Account Mandiri:</p>
                    <p><strong>Bill Key:</strong> {{ $pesanan->bill_key }}</p>
                    <p><strong>Biller Code:</strong> {{ $pesanan->biller_code }}</p>
                    @if($pesanan->expiry_time)
                        <p><strong>Berlaku Sampai:</strong> {{ \Carbon\Carbon::parse($pesanan->expiry_time)->format('d M Y H:i') }}</p>
                    @endif
                    <p class="text-sm text-gray-500 mt-2">Silakan bayar melalui ATM Mandiri, Livin' by Mandiri, atau channel Mandiri lainnya sebelum batas waktu yang ditentukan.</p>
                </div>
            @endif

            <div class="mt-6 text-center">
                <a href="{{ route('home') }}"
                    class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
