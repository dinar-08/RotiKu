<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Pesanan;
use Midtrans\Transaction;
use Midtrans\Config;
use Illuminate\Support\Facades\Log;

class CekStatusMidtrans extends Command
{
    protected $signature = 'cek:midtrans';
    protected $description = 'Cek status pembayaran Midtrans dan update status pesanan';

    public function handle()
    {
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');

        $pesanans = Pesanan::where('metode_pembayaran', 'mandiri_va')
            ->whereIn('status', ['menunggu', 'kedaluwarsa'])
            ->get();

        if ($pesanans->isEmpty()) {
            $this->info('Tidak ada pesanan yang perlu diperiksa.');
            return;
        }

        foreach ($pesanans as $pesanan) {
            try {
                $status = Transaction::status($pesanan->kode_pesanan);
                $oldStatus = $pesanan->status;

                $pesanan->status = match ($status->transaction_status) {
                    'settlement', 'capture' => 'berhasil',
                    'pending' => 'menunggu',
                    'expire' => 'kedaluwarsa',
                    'cancel' => 'dibatalkan',
                    default => 'menunggu',
                };

                $pesanan->save();

                $this->info("[$pesanan->kode_pesanan] $oldStatus -> $pesanan->status");
            } catch (\Exception $e) {
                Log::error("Gagal cek status untuk pesanan {$pesanan->kode_pesanan}: " . $e->getMessage());
                $this->error("Error: " . $e->getMessage());
            }
        }
    }
}
