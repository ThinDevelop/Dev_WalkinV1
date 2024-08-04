<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VechicleCostType extends Model
{
    protected $table = 'vechicle_cost_type';
    protected $fillable = [
        'name',
    ];

    public function settingHour()
    {
        return $this->hasMany(SettingHour::class);
    }

    public function SettingVechicleStampType()
    {
        return $this->hasMany(SettingVechicleStampType::class);
    }

    public $timestamps = true;
}
