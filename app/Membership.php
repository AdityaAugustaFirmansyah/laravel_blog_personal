<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'membership';
    protected $timestamp = 'false';

    public function member()
    {
       return $this->hasMany(User::class,'id');
    }
}
