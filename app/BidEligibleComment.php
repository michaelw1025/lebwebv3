<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidEligibleComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'comment'
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


    // ****************************************
    // Relationships
    // ****************************************

    // Employee relationship
    public function employee()
    {
        return $this->belongsTo('App\Employee')->orderBy('created_at', 'desc');
    }
}
