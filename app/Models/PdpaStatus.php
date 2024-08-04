<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PdpaStatus extends Model
{
    protected $table = 'pdpa_status';
    protected $fillable = [
        'name',
    ];
    public $timestamps = true;

    public function contactTransection()
    {
        return $this->belongsTo(ContactTransection::class);
    }
}
