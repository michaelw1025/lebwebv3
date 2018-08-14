<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_initial',
        'ssn',
        'oracle_number',
        'birth_date',
        'hire_date',
        'service_date',
        'maiden_name',
        'nick_name',
        'gender',
        'suffix',
        'address_1',
        'address_2',
        'city',
        'state',
        'zip_code',
        'county',
        'status',
        'rehire',
        'bid_eligible',
        'bid_eligible_date',
        'photo_link',
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
        'birth_date',
        'hire_date',
        'service_date',
        'bid_eligible_date',
    ];

    // ****************************************
    // Mutators
    // ****************************************

    // Set first name format
    public function setFirstNameAttribute($firstName)
    {
        $this->attributes['first_name'] = strtolower($firstName);
    }

    // Get first name format
    public function getFirstNameAttribute($firstName)
    {
        return ucWords($firstName);
    }

    // Set last name format
    public function setLastNameAttribute($lastName)
    {
        $this->attributes['last_name'] = strtolower($lastName);
    }

    // Get last name format
    public function getLastNameAttribute($lastName)
    {
        return ucWords($lastName);
    }

    // Set middle initial format
    public function setMiddleInitialAttribute($middleInitial)
    {
        $this->attributes['middle_initial'] = strtolower($middleInitial);
    }

    // Get middle initial format
    public function getMiddleInitialAttribute($middleInitial)
    {
        return ucWords($middleInitial);
    }

    // Set ssn format
    public function setSsnAttribute($ssn)
    {
        $this->attributes['ssn'] = preg_replace('/[^0-9]/', '', $ssn);
    }

    // Get ssn format
    public function getSsnAttribute($ssn)
    {
        $formattedSSN = substr_replace($ssn, '-', 5, 0);
        $formattedSSN = substr_replace($formattedSSN, '-', 3, 0);
        return $formattedSSN;
    }

    // Set birth date format
    public function setBirthDateAttribute($date)
    {
        $this->attributes['birth_date'] = Carbon::parse($date);
    }

    // Set hire date format
    public function setHireDateAttribute($date)
    {
        $this->attributes['hire_date'] = Carbon::parse($date);
    }

    // Set service date format
    public function setServiceDateAttribute($date)
    {
        $this->attributes['service_date'] = Carbon::parse($date);
    }

    // Set nick name format
    public function setNickNameAttribute($nickName)
    {
        $this->attributes['nick_name'] = strtolower($nickName);
    }

    // Get nick name format
    public function getNickNameAttribute($nickName)
    {
        return ucWords($nickName);
    }

    // Set maiden name format
    public function setMaidenNameAttribute($maidenName)
    {
        $this->attributes['maiden_name'] = strtolower($maidenName);
    }

    // Get maiden name format
    public function getMaidenNameAttribute($maidenName)
    {
        return ucWords($maidenName);
    }

    // Set address 1 format
    public function setAddress1Attribute($address1)
    {
        $this->attributes['address_1'] = strtolower($address1);
    }

    // Get address 1 format
    public function getAddress1Attribute($address1)
    {
        return ucWords($address1);
    }

    // Set address 2 format
    public function setAddress2Attribute($address2)
    {
        $this->attributes['address_2'] = strtolower($address2);
    }

    // Get address 2 format
    public function getAddress2Attribute($address2)
    {
        return ucWords($address2);
    }

    // Set city format
    public function setCityAttribute($city)
    {
        $this->attributes['city'] = strtolower($city);
    }

    // Get city format
    public function getCityAttribute($city)
    {
        return ucWords($city);
    }

    // Set county format
    public function setCountyAttribute($county)
    {
        $this->attributes['county'] = strtolower($county);
    }

    // Get county format
    public function getCountyAttribute($county)
    {
        return ucWords($county);
    }

    // Set bid eligible date format
    public function setBidEligibleDateAttribute($date)
    {
        $this->attributes['bid_eligible_date'] = Carbon::parse($date);
    }

    // ****************************************
    // Relationships
    // ****************************************
    //Cost Center relationship
    public function costCenter()
    {
        return $this->belongsToMany('App\CostCenter');
    }

    // Staff Manager relationship
    public function costCenterStaffManager()
    {
        return $this->belongsToMany('App\CostCenter', 'cost_center_staff_manager');
    }

    // Day Team Manager relationship
    public function costCenterDayTeamManager()
    {
        return $this->belongsToMany('App\CostCenter', 'cost_center_day_team_manager');
    }

    // Night Team Manager relationship
    public function costCenterNightTeamManager()
    {
        return $this->belongsToMany('App\CostCenter', 'cost_center_night_team_manager');
    }

    // Day Team Leader relationship
    public function costCenterDayTeamLeader()
    {
        return $this->belongsToMany('App\CostCenter', 'cost_center_day_team_leader');
    }

    // Night Team Leader relationship
    public function costCenterNightTeamLeader()
    {
        return $this->belongsToMany('App\CostCenter', 'cost_center_night_team_leader');
    }

    //Shift relationship
    public function shift()
    {
        return $this->belongsToMany('App\Shift');
    }

    //Position relationship
    public function position()
    {
        return $this->belongsToMany('App\Position');
    }

    //Job relationship
    public function job()
    {
        return $this->belongsToMany('App\Job');
    }

    // Phone Number relationship
    public function phoneNumber()
    {
        return $this->hasMany('App\PhoneNumber')->orderBy('is_primary', 'desc');
    }

    // Emergency Contact relationship
    public function emergencyContact()
    {
        return $this->hasMany('App\EmergencyContact')->orderBy('is_primary', 'desc');
    }

    // Disciplinary relationship
    public function disciplinary()
    {
        return $this->hasMany('App\Disciplinary')->orderBy('type', 'asc')->orderBy('date', 'desc');
    }

    // Termination relationship
    public function termination()
    {
        return $this->hasMany('App\Termination')->orderBy('date', 'desc');
    }

    // Reduction relationship
    public function reduction()
    {
        return $this->hasMany('App\Reduction')->orderBy('date', 'desc');
    }

    //Wage progression relationship
    public function wageProgression()
    {
        return $this->belongsToMany('App\WageProgression')->withPivot('date');
    }
}
