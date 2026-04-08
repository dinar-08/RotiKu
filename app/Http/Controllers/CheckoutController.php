<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProdukRoti;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\CoreApi;

class CheckoutController extends Controller
{
    public function metode()
    {
        return view('checkout.metode');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:mandiri_va,Tunai',
        ]);

        $user = Auth::user();
        $keranjang = Keranjang::with('produk')->where('user_id', $user->id)->get();

        if ($keranjang->isEmpty()) {
            return redirect()->route('keranjang.index')->with('error', 'Keranjang Anda kosong.');
        }

        $total = $keranjang->sum(function ($item) {
            return $item->produk->harga * $item->jumlah;
        });

        $kodePesanan = 'INV' . date('Ymd') . strtoupper(Str::random(5));

        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'kode_pesanan' => $kodePesanan,
            'total_harga' => $total,
            'status' => 'menunggu',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        foreach ($keranjang as $item) {
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'produk_roti_id' => $item->produk_id,
                'jumlah' => $item->jumlah,
                'harga_satuan' => $item->produk->harga,
            ]);

            $item->produk->decrement('stok', $item->jumlah);
        }

        // Kosongkan keranjang
        Keranjang::where('user_id', $user->id)->delete();

        if ($request->metode_pembayaran === 'mandiri_va') {
            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'payment_type' => 'echannel',
                'transaction_details' => [
                    'order_id' => $pesanan->kode_pesanan,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'echannel' => [
                    'bill_info1' => 'Pembayaran Roti',
                    'bill_info2' => 'UDB Bakery',
                ],
            ];

            try {
                $response = CoreApi::charge($params);

                $pesanan->update([
                    'bill_key' => $response->bill_key ?? null,
                    'biller_code' => $response->biller_code ?? null,
                    'expiry_time' => $response->expiry_time ?? now()->addDay(),
                ]);

                return redirect()->route('checkout.sukses')->with([
                    'pesanan_id' => $pesanan->id,
                    'bill_key' => $response->bill_key ?? null,
                    'biller_code' => $response->biller_code ?? null,
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                return back()->with('error', 'Gagal memproses pembayaran.');
            }
        }

        return redirect()->route('checkout.sukses')->with('pesanan_id', $pesanan->id);
    }

    public function beliLangsung(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk_roti,id',
            'quantity' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:mandiri_va,Tunai',
        ]);

        $user = Auth::user();
        $produk = ProdukRoti::findOrFail($request->produk_id);

        $total = $produk->harga * $request->quantity;
        $kodePesanan = 'INV' . date('Ymd') . strtoupper(Str::random(5));

        $pesanan = Pesanan::create([
            'user_id' => $user->id,
            'kode_pesanan' => $kodePesanan,
            'total_harga' => $total,
            'status' => 'menunggu',
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        DetailPesanan::create([
            'pesanan_id' => $pesanan->id,
            'produk_roti_id' => $produk->id,
            'jumlah' => $request->quantity,
            'harga_satuan' => $produk->harga,
        ]);

        $produk->decrement('stok', $request->quantity);

        if ($request->metode_pembayaran === 'mandiri_va') {
            Config::$serverKey = config('midtrans.serverKey');
            Config::$isProduction = config('midtrans.isProduction');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'payment_type' => 'echannel',
                'transaction_details' => [
                    'order_id' => $pesanan->kode_pesanan,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'echannel' => [
                    'bill_info1' => 'Pembayaran Roti Langsung',
                    'bill_info2' => 'UDB Bakery',
                ],
            ];

            try {
                $response = CoreApi::charge($params);

                $pesanan->update([
                    'bill_key' => $response->bill_key ?? null,
                    'biller_code' => $response->biller_code ?? null,
                    'expiry_time' => $response->expiry_time ?? now()->addDay(),
                ]);

                return redirect()->route('checkout.sukses')->with([
                    'pesanan_id' => $pesanan->id,
                    'bill_key' => $response->bill_key ?? null,
                    'biller_code' => $response->biller_code ?? null,
                ]);
            } catch (\Exception $e) {
                Log::error('Midtrans Error (Langsung): ' . $e->getMessage());
                return back()->with('error', 'Gagal memproses pembayaran.');
            }
        }

        return redirect()->route('checkout.sukses')->with('pesanan_id', $pesanan->id);
    }

    public function sukses()
    {
        $pesananId = session('pesanan_id');
        if (!$pesananId) {
            return redirect()->route('home')->with('error', 'Pesanan tidak ditemukan.');
        }

        $pesanan = Pesanan::with('detailPesanan.produk')->findOrFail($pesananId);
        return view('checkout.sukses', [
            'pesanan' => $pesanan,
        ]);
    }

    public function handleCallback(Request $request)
    {
        $expectedSignature = hash('sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            config('midtrans.serverKey')
        );

        if ($request->signature_key !== $expectedSignature) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $pesanan = Pesanan::where('kode_pesanan', $request->order_id)->first();
        if (!$pesanan) return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);

        switch ($request->transaction_status) {
            case 'capture':
            case 'settlement':
                $pesanan->status = 'berhasil';
                break;
            case 'pending':
                $pesanan->status = 'menunggu';
                break;
            case 'expire':
                $pesanan->status = 'kedaluwarsa';
                break;
            case 'cancel':
                $pesanan->status = 'dibatalkan';
                break;
        }

        $pesanan->save();
        return response()->json(['message' => 'Notifikasi diproses'], 200);
    }
}
