<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->string('bill_key')->nullable()->after('status');
            $table->string('biller_code')->nullable()->after('bill_key');
            $table->timestamp('expiry_time')->nullable()->after('biller_code');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['bill_key', 'biller_code', 'expiry_time']);
        });
    }
};
