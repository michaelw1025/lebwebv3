<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contractor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contractor_name',
        'contact_first_name',
        'contact_last_name',
        'contact_email',
        'contact_phone_number',
        'general_liability_insurance_date',
        'work_comp_employment_insurance_date',
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
        'general_liability_insurance_date', 
        'work_comp_employment_insurance_date',
    ];

    // ****************************************
    // Mutators
    // ****************************************
    // Set contractor name format
    public function setContractorNameAttribute($name)
    {
        $this->attributes['contractor_name'] = strtolower($name);
    }

    // Set contact first name format
    public function setContactFirstNameAttribute($firstName)
    {
        $this->attributes['contact_first_name'] = strtolower($firstName);
    }

    // Set contact last name format
    public function setContactLastNameAttribute($lastName)
    {
        $this->attributes['contact_last_name'] = strtolower($lastName);
    }

    // Set general liability insurance date format
    public function setGeneralLiabilityInsuranceDateAttribute($date)
    {
        $this->attributes['general_liability_insurance_date'] = Carbon::parse($date);
    }

    // Set work comp employment insurance date format
    public function setWorkCompEmploymentInsuranceDateAttribute($date)
    {
        $this->attributes['work_comp_employment_insurance_date'] = Carbon::parse($date);
    }

    // ****************************************
    // Relationships
    // ****************************************
    // Contractor Training relationship
    public function contractorTraining()
    {
        return $this->hasMany('App\ContractorTraining');
    }
}
