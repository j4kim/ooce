<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function things()
    {
        return $this->hasMany(Thing::class);
    }
}
