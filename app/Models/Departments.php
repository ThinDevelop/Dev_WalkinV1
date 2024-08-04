<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = 'departments';
    protected $fillable = [
        'company_id', 'name', 'description', 'sorting', 'status',
    ];
    public $timestamps = true;

    // กำหนดความสัมพันธ์กลับไปยัง Appointment (optional)
    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'department_id');
    }

}
