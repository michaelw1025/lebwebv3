<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // ****************************************
    // Mutators
    // ****************************************
    // Set name format
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }
    // Get name format
    public function getNameAttribute($name)
    {
        return strtolower($name);
    }
    // Set description format
    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = strtolower($description);
    }
    // Get description format
    public function getDescriptionAttribute($description)
    {
        return ucwords($description);
    }

    // ****************************************
    // Relationships
    // ****************************************
    // User
    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
