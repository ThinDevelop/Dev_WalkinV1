<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingHour extends Model
{
    protected $table = 'setting_hour';
    protected $fillable = [
        'company_id',
        'vechicle_cost_types_id',
        'status',
        'cost',
        'status_stamp',
        'setting_parking_company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function vechicleCostType()
    {
        return $this->belongsTo(VechicleCostType::class, 'vechicle_cost_types_id');
    }

    public function settingCost()
    {
        return $this->hasMany(SettingCost::class);
    }

    public function RelStampTypeSettingHours()
    {
        return $this->hasMany(RelStampTypeSettingHour::class);
    }

    public function RelStampTypeSettingHour()
    {
        return $this->hasOne(RelStampTypeSettingHour::class);
    }

    public $timestamps = true;
}
