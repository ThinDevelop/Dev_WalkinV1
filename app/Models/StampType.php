<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StampType extends Model
{
    protected $table = 'stamp_type';

    protected $fillable = [
        'id',
        'name',
        'status'
    ];

}
