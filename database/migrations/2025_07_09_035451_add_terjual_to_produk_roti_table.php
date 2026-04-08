<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom 'terjual' ke tabel produk_roti.
     */
    public function up(): void
    {
        Schema::table('produk_roti', function (Blueprint $table) {
            $table->unsignedInteger('terjual')->default(0)->after('stok');
        });
    }

    /**
     * Hapus kolom 'terjual' jika rollback dilakukan.
     */
    public function down(): void
    {
        Schema::table('produk_roti', function (Blueprint $table) {
            $table->dropColumn('terjual');
        });
    }
};
