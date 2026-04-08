<x-app-layout>
    <div class="py-10 bg-amber-50 min-h-screen">
        <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Pilih Metode Pembayaran</h2>

            <form action="{{ route('checkout.proses') }}" method="POST" class="space-y-4">
                @csrf

                <div class="space-y-2">
                    <label class="block text-gray-700 font-medium">Metode Pembayaran</label>
                    <select name="metode_pembayaran" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="">Pilih Metode</option>
                        <option value="mandiri_va">Virtual Account Mandiri</option>
                        <option value="Tunai">Tunai</option>
                    </select>
                </div>

                <div class="text-right mt-6">
                    <button type="submit" class="bg-amber-500 text-white px-6 py-2 rounded-lg hover:bg-amber-600">
                        Lanjutkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
