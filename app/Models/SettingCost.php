<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCost extends Model
{
    protected $table = 'setting_cost';
    protected $fillable = [
        'setting_hour_id',
        'cost',
        'start_hour',
        'end_hour',
    ];

    public function settingHour()
    {
        return $this->belongsTo(SettingHour::class);
    }

    public $timestamps = true;
}
