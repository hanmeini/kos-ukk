<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Facility;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $facilities = ['WiFi', 'AC', 'Kamar Mandi Dalam', 'Parkir Motor', 'Parkir Mobil', 'Dapur Umum', 'CCTV', 'Kasur'];

    foreach ($facilities as $f) {
        DB::table('facilities')->insert(['name' => $f, 'created_at' => now(), 'updated_at' => now()]);
    }
}
}
