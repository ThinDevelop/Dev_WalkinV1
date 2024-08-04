<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDeviceEdc extends Model
{
    protected $table = 'company_device_edc';
    protected $fillable = [
        'company_parent_id', 'edc_id', 'action', 'device_status',
    ];
    public $timestamps = true;
}
