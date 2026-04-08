<?php

namespace Database\Seeders;

use App\Models\KategoriRoti;
use Illuminate\Database\Seeder;

class KategoriRotiSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            ['nama_kategori' => 'Roti Tawar', 'slug' => 'roti-tawar', 'deskripsi' => 'Berbagai macam roti tawar'],
            ['nama_kategori' => 'Roti Manis', 'slug' => 'roti-manis', 'deskripsi' => 'Roti dengan rasa manis'],
            ['nama_kategori' => 'Roti Kering', 'slug' => 'roti-kering', 'deskripsi' => 'Roti yang tahan lama'],
        ];

        foreach ($kategoris as $kategori) {
            KategoriRoti::create($kategori);
        }
    }
}