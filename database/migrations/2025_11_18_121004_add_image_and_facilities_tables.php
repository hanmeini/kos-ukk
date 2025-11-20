<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    // 1. Tambah kolom gambar di tabel koses
    Schema::table('koses', function (Blueprint $table) {
        // Cek dulu biar gak error kalau kolomnya sudah ada
        if (!Schema::hasColumn('koses', 'image')) {
            $table->string('image')->nullable()->after('description');
        }
    });

    // 2. Buat tabel master fasilitas
    // Cek if not exists biar aman
    if (!Schema::hasTable('facilities')) {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    // 3. Buat tabel Pivot (Penghubung Kos & Fasilitas)
    Schema::create('kos_facility', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kos_id')->constrained('koses')->onDelete('cascade');
        $table->foreignId('facility_id')->constrained('facilities')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('kos_facility');
    Schema::dropIfExists('facilities');
    Schema::table('koses', function (Blueprint $table) {
        $table->dropColumn('image');
    });
}
};
