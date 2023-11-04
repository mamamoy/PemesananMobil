<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class Offices extends Model
{
    use HasFactory;
    protected $table = 'offices';
    protected $fillable = [
        'office_name',
        'office_type',
    ];

    public function user(){
        return $this->belongsToMany(User::class, 'id', 'user_id');
    }

    public function officeType(){
        return $this->belongsTo(Offices::class, 'id', 'office_type_id');
    }
}
