<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;

class PesananController extends Controller
{
    // Menampilkan riwayat dengan filter status (semua, menunggu, berhasil, dibatalkan)
    public function riwayat(Request $request)
    {
        $status = $request->query('status'); // ambil query ?status=

        $query = Pesanan::with('detailPesanan.produk')
            ->where('user_id', Auth::id())
            ->latest();

        if ($status && $status !== 'semua') {
            $query->where('status', $status);
        }

        $pesanans = $query->get();

        return view('pesanan.riwayat', compact('pesanans'));
    }

    // Tampilkan detail pesanan
    public function detail($id)
    {
        $pesanan = Pesanan::with('detailPesanan.produk')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pesanan.detail', compact('pesanan'));
    }
}
