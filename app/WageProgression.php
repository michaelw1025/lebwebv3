<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WageProgression extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month',
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
    
    // ****************************************
    // Relationships
    // ****************************************
    // Wage Title relationship
    public function wageTitle()
    {
        return $this->belongsToMany('App\WageTitle')->withPivot('id', 'amount')->orderBy('month', 'asc');
    }

    public function wageTitleQuery()
    {
        return $this->belongsToMany('App\WageTitle')->withPivot('id', 'amount');
    }

    //Employee relationship
    public function employee()
    {
        return $this->belongsToMany('App\Employee')->withPivot('date');
    }
}
