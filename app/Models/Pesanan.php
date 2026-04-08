<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanans'; // pastikan sesuai dengan nama tabel kamu

    // App\Models\Pesanan.php
    protected $fillable = [
        'user_id',
        'kode_pesanan',
        'total_harga',
        'status',
        'metode_pembayaran',
        'bill_key',
        'biller_code',
        'expiry_time',
    ];


    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke DetailPesanan
     */
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}

