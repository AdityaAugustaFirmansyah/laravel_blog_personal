<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentar extends Model
{
    protected $fillable = ['blog_id','user_id','comentar'];
    protected $dates=['created_at','updated_at'];

    public function namas()
    {
        return $this->belongsTo('App\User','user_id');
    }
}