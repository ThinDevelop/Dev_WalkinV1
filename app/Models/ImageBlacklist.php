<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageBlacklist extends Model
{
    protected $table = 'image_blacklist';
    protected $fillable = [
        'image_url',
    ];

    public $timestamps = true;
}
