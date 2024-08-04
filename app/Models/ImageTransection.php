<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageTransection extends Model
{
    protected $table = 'image_transection';
    protected $fillable = [
        'image_url', 'contact_id', 'image_type_id',
    ];
}
