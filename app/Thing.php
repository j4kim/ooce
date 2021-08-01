<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thing extends Model
{
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($thing) {
            $ref = $thing->group->counter++;
            $thing->group->save();
            $thing->ref = $ref;
        });
    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

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
