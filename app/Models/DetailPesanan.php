<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanans'; // Sesuaikan jika nama tabel berbeda

    protected $fillable = [
        'pesanan_id',
        'produk_roti_id',
        'jumlah',
        'harga_satuan',
    ];

    /**
     * Relasi ke Pesanan
     */
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    /**
     * Relasi ke ProdukRoti, gunakan nama metode 'produk' agar bisa dipanggil dengan $detail->produk
     */
    public function produk()
    {
        return $this->belongsTo(ProdukRoti::class, 'produk_roti_id');
    }
}
