<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $table = 'facilities';
    protected $fillable = ['name'];

    // Relasi ke Kos
    public function koses() {
        return $this->belongsToMany(Kos::class, 'kos_facility');
    }
}
