<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pdpa extends Model
{
 
    use SoftDeletes;

    protected $table = 'pdpa';
    protected $fillable = [
        'pdpa', 'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public $timestamps = true;
}
