<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyParent extends Model
{
    protected $table = 'company_parent';
    protected $fillable = [
        'name', 'address', 'phone', 'email', 'status',
    ];
    public $timestamps = true;
   
}
