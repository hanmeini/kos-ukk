<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Kos;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        $kos = Kos::first();

        if($user && $kos) {
            // Buat 1 pesanan status Pending
            Booking::create([
                'user_id' => $user->id,
                'kos_id' => $kos->id,
                'start_date' => now()->addDays(3),
                'duration' => 1,
                'total_price' => $kos->price,
                'status' => 'pending',
            ]);

            // Buat 1 pesanan status Paid (Menunggu Verifikasi)
            Booking::create([
                'user_id' => $user->id,
                'kos_id' => $kos->id,
                'start_date' => now()->addDays(5),
                'duration' => 3,
                'total_price' => $kos->price * 3,
                'status' => 'paid',
                'payment_proof' => 'dummy_proof.jpg'
            ]);
        }
    }
}
