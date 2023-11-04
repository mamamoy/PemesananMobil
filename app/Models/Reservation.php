<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'driver_id',
        'approval',
        'start_date',
        'end_date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vehicle(){
        return $this->belongsTo(Vehicles::class, 'vehicle_id');
    }

    public function driver(){
        return $this->belongsTo(Drivers::class, 'driver_id');
    }
}
