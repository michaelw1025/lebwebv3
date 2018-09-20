<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'posting_number',
        'post_date',
        'pull_date',
        'team_id',
        'position_id',
        'shift_id',
        'number_of_openings',
        'top_wage_id',
        'top_wage_with_education_id',
        'education_requirement',
        'resume_required',
        'tech_form_required',
        'summary',
        'essential_duties_responsibilities',
        'qualifications',
        'successful_bidder',
        'education_experience',
        'physical_demands',
        'math_skills'
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
        'post_date',
        'pull_date'
    ];

    // ****************************************
    // Mutators
    // ****************************************

    // ****************************************
    // Relationships
    // ****************************************
    // Team relationship
    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    // Position relationship
    public function position()
    {
        return $this->belongsTo('App\Position');
    }

    // Shift relationship
    public function shift()
    {
        return $this->belongsTo('App\Shift');
    }
}
