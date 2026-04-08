<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // $this->call([
        //     KategoriRotiSeeder::class,
        //     ProdukRotiSeeder::class,
        // ]);
    

        {
        // User::factory(10)->create();

            User::factory()->create([
                'name' => 'coba',
                'email' => 'coba@example.com',
                'password' => Hash::make('coba')
            ]);
        }
    }
}