<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BidEducationTopWage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wage_progression_wage_title';

    // ****************************************
    // Relationships
    // ****************************************
    // Bid relationship
    public function bid()
    {
        return $this->hasMany('App\Bid');
    }
}
