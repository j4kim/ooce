<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $with = ['children'];

    public function children()
    {
        return $this->hasMany('App\Thing', 'parent_id');
    }
}
