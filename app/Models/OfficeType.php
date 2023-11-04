<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeType extends Model
{
    use HasFactory;

    protected $table = 'officetypes';

    protected $fillable = [
        'office_name',
        'office_type_id'
    ];

    public function office(){
        return $this->hasOne(OfficeType::class, 'id', 'office_type_id');
    }
}
