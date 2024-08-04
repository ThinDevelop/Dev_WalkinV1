<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blacklist extends Model
{
    protected $table = 'blacklist';
    protected $fillable = [
        'idcard',
        'fullname',
        'note',
        'company_id',
        'contact_transaction_id',
        'image_type',
        'image_blacklist_id',
        'address',
        'car_registration',
        'from',
        'status',
    ];

    public function contactTransection()
    {
        return $this->belongsTo(ContactTransection::class, 'contact_transaction_id');
    }

    public function imageType()
    {
        return $this->belongsTo(ImageType::class, 'image_type');
    }

    public function imageBlacklist()
    {
        return $this->belongsTo(ImageBlacklist::class, 'image_blacklist_id');
    }

    public $timestamps = true;
}
