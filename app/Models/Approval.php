<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    protected $table = 'confirmation';
    protected $fillable = [
        'reservation_id',
        'user_approve_id',
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class,'reservation_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_approve_id');
    }
}
