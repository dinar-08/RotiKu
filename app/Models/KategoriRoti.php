<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriRoti extends Model
{
    use HasFactory;

    protected $table = 'kategori_roti';
    protected $fillable = ['nama_kategori', 'deskripsi'];

    public function produk(): HasMany
    {
        return $this->hasMany(ProdukRoti::class, 'kategori_id');
    }
}