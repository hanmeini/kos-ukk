<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $table = 'koses';
    protected $fillable = [
        'name',
        'description',
        'price',
        'location',
        'status',
        'image'
    ];

    // Relasi ke Fasilitas
    public function facilities() {
        return $this->belongsToMany(Facility::class, 'kos_facility');
    }
}
