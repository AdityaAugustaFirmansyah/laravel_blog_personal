<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog' ;
    protected $fillable = ['tiitle','desc','category_id','image','content','user_id'];
    protected $dates=['created_at','updated_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function namas()                                                                                                                                                                                                                                                                                                                                                                                                                         
    {
        return $this->hasMany(Comentar::class,'id');
    }
}