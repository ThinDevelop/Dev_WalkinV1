<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelStampTypeSettingHour extends Model
{
    protected $table = 'rel_stamp_type_setting_hour';
    public $timestamps = true;

    protected $fillable = [
        "setting_hour_id",
        "stamp_type_id",
        "num_hour"
    ];

    public function StampType()
    {
        return $this->belongsTo(StampType::class);
    }

}
