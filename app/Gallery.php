<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'gallery';
    protected $dates= ['created_at','updated_at'];

    public function name()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
