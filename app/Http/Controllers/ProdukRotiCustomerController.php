<?php

namespace App\Http\Controllers;

use App\Models\ProdukRoti;
use Illuminate\Http\Request;

class ProdukRotiCustomerController extends Controller
{
    public function index()
    {
        $produk = ProdukRoti::with('kategori')->where('stok', '>', 0)->get();
        return view('customer.produk.index', compact('produk'));
    }
}
