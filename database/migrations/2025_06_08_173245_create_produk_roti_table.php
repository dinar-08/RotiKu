<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produk_roti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_roti');
            $table->string('nama_produk');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk_roti');
    }
};