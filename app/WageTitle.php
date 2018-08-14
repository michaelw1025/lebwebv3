<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WageTitle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    // ****************************************
    // Mutators
    // ****************************************
    // Set description format
    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = strtolower($description);
    }

    // ****************************************
    // Relationships
    // ****************************************
    // Position relationship
    public function position()
    {
        return $this->belongsToMany('App\Position');
    }
}
