<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractVechicle extends Model
{
    protected $table = 'contract_vechicle';
    public $timestamps = true;
    protected $fillable = [
        'vechicle_function_id', 'contract_code', 'start_date', 'end_date', 'company_id', 'status'
    ];

    public function vehicleFunction()
    {
        return $this->belongsTo(VechicleFunction::class, 'vechicle_function_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
