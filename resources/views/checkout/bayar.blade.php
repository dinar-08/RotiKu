<x-app-layout>
    <div class="py-10 bg-amber-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- No 1: Detail Struk Pesanan -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-bold mb-4 text-gray-800">Detail Pesanan</h2>
                <div class="text-gray-700 text-sm space-y-2">
                    <p><strong>Nama Pemesan:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Tanggal:</strong> {{ now()->format('d M Y, H:i') }}</p>
                    <hr class="my-3">
                    
                    @foreach ($pesanan->detailPesanan as $detail)
                        <div class="flex justify-between">
                            <span>{{ $detail->produk->nama_produk }} x{{ $detail->jumlah }}</span>
                            <span>Rp {{ number_format($detail->produk->harga * $detail->jumlah, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <hr class="my-3">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-amber-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- No 2: Tombol Bayar -->
            <div class="text-center mt-6">
                <button id="pay-button"
                        class="px-6 py-3 bg-amber-500 text-white font-semibold rounded-lg hover:bg-amber-600 transition">
                    Bayar Sekarang
                </button>
            </div>

        </div>
    </div>

    <!-- No 3: Midtrans Snap Script -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.clientKey') }}"></script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = "{{ route('checkout.sukses') }}";
                },
                onPending: function (result) {
                    console.log('Pending:', result);
                },
                onError: function (result) {
                    console.log('Error:', result);
                }
            });
        });
    </script>
</x-app-layout>
