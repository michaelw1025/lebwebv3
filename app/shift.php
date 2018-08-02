<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shift extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'code'
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

    // Get description format
    public function getDescriptionAttribute($description)
    {
        return ucWords($description);
    }

    // Set code format
    public function setcodeAttribute($code)
    {
        $this->attributes['code'] = strtolower($code);
    }

    // ****************************************
    // Relationships
    // ****************************************
    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee');
    }
}
