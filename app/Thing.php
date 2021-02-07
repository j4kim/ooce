<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $guarded = [];

    public function children()
    {
        return $this->hasMany('App\Thing', 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Thing', 'parent_id');
    }

    public function moveTo($parent_id)
    {
        $this->parent_id = $parent_id;
        $this->moved_at = now();
        $this->save();
    }
}
