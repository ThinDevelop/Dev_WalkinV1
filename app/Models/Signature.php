<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    //
    protected $table = 'signture_form';
    protected $fillable = ['company_id','name','sorting'];
    public $timestamps = true;

}
