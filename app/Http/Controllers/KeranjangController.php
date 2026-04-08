<?php

namespace App\Http\Controllers;

use App\Models\ProdukRoti;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Auth::user()->keranjang()->with('produk')->get();

        return view('keranjang.index', [
            'items' => $items,
            'total' => $items->sum(function ($item) {
                return $item->produk->harga * $item->jumlah;
            }),
        ]);
    }

    public function tambah(Request $request, ProdukRoti $produk)
    {
        $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $item = Keranjang::where('user_id', $user->id)
            ->where('produk_id', $produk->id)
            ->first();

        if ($item) {
            $item->jumlah += $request->jumlah;
            $item->save();
        } else {
            Keranjang::create([
                'user_id' => $user->id,
                'produk_id' => $produk->id,
                'jumlah' => $request->jumlah,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $keranjang = Keranjang::findOrFail($id);

        // Pastikan hanya pemilik yang bisa update
        if ($keranjang->user_id !== Auth::id()) {
            return back()->with('error', 'Tidak diizinkan.');
        }

        $jumlahBaru = max(1, (int) $request->input('jumlah')); // Minimal 1

        $keranjang->jumlah = $jumlahBaru;
        $keranjang->save();

        return back()->with('success', 'Jumlah berhasil diperbarui.');
    }

    public function hapus(Keranjang $keranjang)
    {
        if ($keranjang->user_id === Auth::id()) {
            $keranjang->delete();
            return back()->with('success', 'Produk dihapus dari keranjang.');
        }

        return back()->with('error', 'Tidak diizinkan.');
    }
}
