<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kos_id',
        'start_date',
        'duration',
        'total_price',
        'status',
        'payment_proof'
    ];

    // Relasi: Booking milik User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi: Booking milik Kos
    public function kos() {
        return $this->belongsTo(Kos::class, 'kos_id');
    }
}
