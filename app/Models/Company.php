<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';
    protected $fillable = [
        'mid',
        'name',
        'address',
        'phone',
        'email',
        'status',
        'logo',
        'line_token',
        'note',
        'status_vehicle',
        'promptpay',
        'company_parent_id'
    ];

    public function contactTransection()
    {
        return $this->hasOne(ContactTransection::class);
    }

    public function contractVechicles()
    {
        return $this->hasOne(ContractVechicle::class, 'company_id', 'id');
    }

    public function contractVechicleActive()
    {
        $date = date('Y-m-d');

        return $this->hasOne(ContractVechicle::class, 'company_id', 'id')
            ->where('contract_vechicle.status', 1)
            ->where(function ($where1) use ($date) {
                $where1->where(function ($query) use ($date) {
                    $query->where('contract_vechicle.vechicle_function_id', 2)
                        ->where('contract_vechicle.end_date', '>=', $date)
                        ->where('contract_vechicle.start_date', '<=', $date);
                })
                ->orWhere('contract_vechicle.vechicle_function_id', 1);
            });
    }

    public function pdpa()
    {
        return $this->hasOne(Pdpa::class);
    }

    public function appointment()
    {
        return $this->hasOne(Appointment::class);
    }

    public function settingParkingCompany()
    {
        return $this->hasOne(SettingParkingCompany::class);
    }

    public $timestamps = true;
}
