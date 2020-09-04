<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function things()
    {
        return $this->hasMany('App\Thing');
    }
}
