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

    public static function search($query, $containersOnly = false)
    {
        $qb = self::where(function ($innerQb) use ($query) {
            $innerQb->where('id', $query)
                    ->orWhere('name', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%");
        });
        if ($containersOnly) {
            $qb->where('thing_container', 1);
        }
        return $qb->get();
    }
}
