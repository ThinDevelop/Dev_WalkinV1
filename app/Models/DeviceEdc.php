<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceEdc extends Model
{
    protected $table = 'device_edc';
    protected $fillable = [
        'company_id', 'company_parent_id', 'serial_number', 'type', 'status',
    ];

    public function getType()
    {
        return $this->belongsTo('App\Models\DeviceType', 'type');
    }

    public function getComapny()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function getComapnyParent()
    {
        return $this->belongsTo('App\Models\CompanyParent', 'company_parent_id');
    }
    public $timestamps = true;
}