<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $with = ['children'];

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany('App\Thing', 'parent_id');
    }
}
