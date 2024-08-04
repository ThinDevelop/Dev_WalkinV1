<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceType extends Model
{
    protected $table = 'device_type';
    protected $fillable = [
        'name',
    ];
    public $timestamps = true;

}