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

    public static function search($query)
    {
        return self::where('id', $query)
            ->orWhere('name', 'like', "%$query%")
            ->get();
    }
}
