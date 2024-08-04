<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    protected $table = 'image_type';
    protected $fillable = [
        'name', 'description',
    ];

    public function imageTransection()
    {
        return $this->belongsTo(Images::class);
    }

    public $timestamps = true;

}