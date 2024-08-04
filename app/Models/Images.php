<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    //
    protected $table = 'image_transection';
    protected $fillable = ['contact_id','image_type_id','image_url'];

    public function contactTransection()
    {
        return $this->belongsTo(ContactTransection::class, 'contact_id');
    }

    public function imageType()
    {
        return $this->belongsTo(ImageType::class, 'image_type_id');
    }
    
    public $timestamps = true;

}