<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    protected $table = 'appointment_status';
    protected $fillable = [
        'name',
    ];
    public $timestamps = true;
}
