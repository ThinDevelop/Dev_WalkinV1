<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingParkingCompany extends Model
{
    protected $table = 'setting_parking_company';
    protected $fillable = [
        'id',
        'name_place',
        'status',
        'company_id'
    ];

    public function settingHours()
    {
        return $this->hasMany(SettingHour::class, 'setting_parking_company_id');
    }

    public function settingHour()
    {
        return $this->hasOne(SettingHour::class, 'setting_parking_company_id');
    }

}
