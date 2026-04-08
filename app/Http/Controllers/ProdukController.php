<?php

namespace App\Http\Controllers;

use App\Models\KategoriRoti;
use App\Models\ProdukRoti;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        $produks = ProdukRoti::with('kategori')->latest()->paginate(12);
        $kategoris = KategoriRoti::all();

        return view('produk.index', compact('produks', 'kategoris'));
    }

    // Menampilkan detail produk
    public function show($id)
    {
        $produk = ProdukRoti::findOrFail($id);
        $produkTerkaits = ProdukRoti::where('kategori_id', $produk->kategori_id)
            ->where('id', '!=', $produk->id)
            ->limit(4)->get();

        return view('produk.show', compact('produk', 'produkTerkaits'));
    }

    // Menampilkan produk berdasarkan kategori
    public function kategori($id)
    {
        $kategori = KategoriRoti::findOrFail($id);
        $produks = $kategori->produk()->latest()->paginate(12);
        $kategoris = KategoriRoti::all();

        return view('produk.kategori', [
            'produks' => $produks,
            'kategoris' => $kategoris,
            'kategoriAktif' => $kategori
        ]);
    }
}
