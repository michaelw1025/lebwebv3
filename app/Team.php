<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be dates.
     *
     * @var array
     */
    protected $dates = [
        
    ];

    // ****************************************
    // Mutators
    // ****************************************
    // Set description format
    public function setDescriptionAttribute($description)
    {
        $this->attributes['description'] = strtolower($description);
    }

    // Get description format
    public function getDescriptionAttribute($description)
    {
        return ucWords($description);
    }

    // ****************************************
    // Relationships
    // ****************************************
    // Bid relationship
    public function bid()
    {
        return $this->hasMany('App\Bid');
    }
}
