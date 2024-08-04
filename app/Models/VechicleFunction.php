<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VechicleFunction extends Model
{
    protected $table = 'vechicle_function';
    protected $fillable = [
        'name',
    ];
    public $timestamps = true;
}
