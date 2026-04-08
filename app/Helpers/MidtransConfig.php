<?php

namespace App\Helpers;

use Midtrans\Config;

class MidtransConfig
{
    public static function init()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false; // Ubah ke true kalau sudah live
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
}
