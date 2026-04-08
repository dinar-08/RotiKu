<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProdukRoti extends Model
{
    use HasFactory;

    protected $table = 'produk_roti';
    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'gambar'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriRoti::class, 'kategori_id');
    }
}
