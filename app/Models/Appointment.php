<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointment';
    protected $fillable = [
        'appointment_code',
        'from',
        'name',
        'lastname',
        'phone',
        'email',
        'date_appointment',
        'start_time',
        'end_time',
        'note',
        'pdpa_id',
        'pdpa_status_id',
        'company_id',
        'department_id',
        'objective_id',
        'status',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function pdpa()
    {
        return $this->hasOne(Pdpa::class, 'id');
    }

    public function pdpaStatus()
    {
        return $this->hasOne(PdpaStatus::class, 'id');
    }

    // กำหนดความสัมพันธ์กับ Department
    public function department()
    {
        return $this->belongsTo(Departments::class, 'department_id');
    }

    // กำหนดความสัมพันธ์กับ ObjectiveType
    public function objectiveType()
    {
        return $this->belongsTo(ObjectiveType::class, 'objective_id');
    }

    public $timestamps = true;
}
