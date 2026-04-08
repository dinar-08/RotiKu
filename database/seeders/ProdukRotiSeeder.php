<?php

namespace Database\Seeders;

use App\Models\ProdukRoti;
use Illuminate\Database\Seeder;

class ProdukRotiSeeder extends Seeder
{
    public function run()
    {
        $produks = [
            [
                'kategori_id' => 1,
                'nama_produk' => 'Roti Tawar Gandum',
                'slug' => 'roti-tawar-gandum',
                'deskripsi' => 'Roti tawar berbahan gandum pilihan',
                'harga' => 15000,
                'stok' => 50,
            ],
            [
                'kategori_id' => 2,
                'nama_produk' => 'Roti Coklat Keju',
                'slug' => 'roti-coklat-keju',
                'deskripsi' => 'Roti manis dengan isian coklat dan keju',
                'harga' => 12000,
                'stok' => 30,
            ],
        ];

        foreach ($produks as $produk) {
            ProdukRoti::create($produk);
        }
    }
}