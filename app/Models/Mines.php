<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mines extends Model
{
    use HasFactory;
    protected $table = 'mines';
    protected $fillable = [
        'mine_name'
    ];
}
