<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $with = ['things'];

    public function things()
    {
        return $this->hasMany('App\Thing');
    }
}
