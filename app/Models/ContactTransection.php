<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactTransection extends Model
{
    protected $table = 'contact_transection';
    protected $fillable = [
        'company_id',
        'department_id',
        'objective_id',
        'user_id',
        'status_pdpa_id',
        'pdpa_id',
        'appointment_id',
        'contact_code',
        'idcard',
        'fullname',
        'gender',
        'birth_date',
        'address',
        'vehicel_registration',
        'temperature',
        'from',
        'checkin_time',
        'checkout_time',
        'objective_note',
        'person_contact',
        'status',
        'price',
        'price_amount',
        'price_discount',
        'payment_id',
        'vechicle_cost_types_id',
        'stamp_type_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getCompany()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function getObjective()
    {
        return $this->belongsTo('App\Models\ObjectiveType', 'objective_id');
    }

    public function getDepartment()
    {
        return $this->belongsTo('App\Models\Departments', 'department_id');
    }

    public function getUsers()
    {
        return $this->belongsTo('App\Models\Users', 'user_id');
    }

    public function getPayment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }

    public function imageTransections()
    {
        return $this->hasMany(Images::class, 'contact_id');
    }

    public $timestamps = true;
}
