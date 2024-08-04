<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ObjectiveType extends Model
{
    //
    // protected $table = 'objective_type';
    // protected $fillable = ['name','description','company_id','sorting','status'];
    // public $timestamps = true;
    
    protected $table = 'objective_type';
    protected $fillable = [
        'company_id', 'name', 'description', 'sorting', 'status',
    ];
    public $timestamps = true;

    // กำหนดความสัมพันธ์กลับไปยัง Appointment (optional)
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'objective_id');
    }
}
