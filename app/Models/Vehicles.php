<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $fillable = [
        'plate_number',
        'vehicle_name',
        'fuel_consume',
        'repair',
        'usage_history',
        'rental_status',
    ];
}
