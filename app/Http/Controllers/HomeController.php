<?php

namespace App\Http\Controllers;

use App\Models\ProdukRoti;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 produk terbaru
        $produkTerbaru = ProdukRoti::orderBy('created_at', 'desc')->take(3)->get();

        // Ambil 3 produk best seller
        $produkBestSeller = ProdukRoti::select('produk_roti.*', DB::raw('SUM(detail_pesanans.jumlah) as total_terjual'))
            ->join('detail_pesanans', 'produk_roti.id', '=', 'detail_pesanans.produk_roti_id')
            ->groupBy(
                'produk_roti.id',
                'produk_roti.kategori_id',
                'produk_roti.nama_produk',
                'produk_roti.deskripsi',
                'produk_roti.harga',
                'produk_roti.stok',
                'produk_roti.terjual',
                'produk_roti.gambar',
                'produk_roti.created_at',
                'produk_roti.updated_at'
            )
            ->orderByDesc('total_terjual')
            ->take(3)
            ->get();

        return view('home', compact('produkTerbaru', 'produkBestSeller'));
    }
}
