<?php

namespace App\Traits;

use App\CostCenter;
use App\Employee;
use App\Shift;
use Carbon\Carbon;

trait HelperFunctions
{
    public function setAsDate($date)
    {
        // $date = Carbon::createFromFormat('m-d-Y', $date)->toDateString();
        return Carbon::parse($date);
    }

    public function checkState($employee)
    {
        switch($employee->state) {
            case 'al':
                $employee->state_full_name = 'Alabama';
                break;
            case 'ak': 
                $employee->state_full_name = 'Alaska';
                break;
            case 'az': 
                $employee->state_full_name = 'Arizona';
                break;
            case 'ar': 
                $employee->state_full_name = 'Arkansas';
                break;
            case 'ca': 
                $employee->state_full_name = 'California';
                break;
            case 'co': 
                $employee->state_full_name = 'Colorado';
                break;
            case 'ct': 
                $employee->state_full_name = 'Connecticut';
                break;
            case 'de': 
                $employee->state_full_name = 'Delaware';
                break;
            case 'dc': 
                $employee->state_full_name = 'District Of Columbia';
                break;
            case 'fl': 
                $employee->state_full_name = 'Florida';
                break;
            case 'ga': 
                $employee->state_full_name = 'Georgia';
                break;
            case 'hi': 
                $employee->state_full_name = 'Hawaii';
                break;
            case 'id': 
                $employee->state_full_name = 'Idaho';
                break;
            case 'il': 
                $employee->state_full_name = 'Illinois';
                break;
            case 'in': 
                $employee->state_full_name = 'Indiana';
                break;
            case 'ia': 
                $employee->state_full_name = 'Iowa';
                break;
            case 'ks': 
                $employee->state_full_name = 'Kansas';
                break;
            case 'ky': 
                $employee->state_full_name = 'Kentucky';
                break;
            case 'la': 
                $employee->state_full_name = 'Louisiana';
                break;
            case 'me': 
                $employee->state_full_name = 'Maine';
                break;
            case 'md': 
                $employee->state_full_name = 'Maryland';
                break;
            case 'ma': 
                $employee->state_full_name = 'Massachusetts';
                break;
            case 'mi': 
                $employee->state_full_name = 'Michigan';
                break;
            case 'mn': 
                $employee->state_full_name = 'Minnesota';
                break;
            case 'ms': 
                $employee->state_full_name = 'Mississippi';
                break;
            case 'mo': 
                $employee->state_full_name = 'Missouri';
                break;
            case 'mt': 
                $employee->state_full_name = 'Montana';
                break;
            case 'ne': 
                $employee->state_full_name = 'Nebraska';
                break;
            case 'nv': 
                $employee->state_full_name = 'Nevada';
                break;
            case 'nh': 
                $employee->state_full_name = 'New Hampshire';
                break;
            case 'nj': 
                $employee->state_full_name = 'New Jersey';
                break;
            case 'nm': 
                $employee->state_full_name = 'New Mexico';
                break;
            case 'ny': 
                $employee->state_full_name = 'New York';
                break;
            case 'nc': 
                $employee->state_full_name = 'North Carolina';
                break;
            case 'nd': 
                $employee->state_full_name = 'North Dakota';
                break;
            case 'oh': 
                $employee->state_full_name = 'Ohio';
                break;
            case 'ok': 
                $employee->state_full_name = 'Oklahoma';
                break;
            case 'or': 
                $employee->state_full_name = 'Oregon';
                break;
            case 'pa': 
                $employee->state_full_name = 'Pennsylvania';
                break;
            case 'ri': 
                $employee->state_full_name = 'Rhode Island';
                break;
            case 'sc': 
                $employee->state_full_name = 'South Carolina';
                break;
            case 'sd': 
                $employee->state_full_name = 'South Dakota';
                break;
            case 'tn': 
                $employee->state_full_name = 'Tennessee';
                break;
            case 'tx': 
                $employee->state_full_name = 'Texas';
                break;
            case 'ut': 
                $employee->state_full_name = 'Utah';
                break;
            case 'vt': 
                $employee->state_full_name = 'Vermont';
                break;
            case 'va': 
                $employee->state_full_name = 'Virginia';
                break;
            case 'wa': 
                $employee->state_full_name = 'Washington';
                break;
            case 'wv': 
                $employee->state_full_name = 'West Virginia';
                break;
            case 'wi': 
                $employee->state_full_name = 'Wisconsin';
                break;
            case 'wy': 
                $employee->state_full_name = 'Wyoming';
                break;
            default:
                $employee->state_full_name = '';
        }           
    }

    // Get disciplinary info
    public function getDisciplinaryInfo($disciplinary)
    {
            $cc = CostCenter::find($disciplinary->cost_center);
            $disciplinary->cost_center_number = $cc->number.' '.$cc->extension;
            $disciplinary->cost_center_name = $cc->description;
            $issuer = Employee::find($disciplinary->issued_by);
            $disciplinary->issuer_name = $issuer->first_name.' '.$issuer->last_name;
    }

    // Get reduction info
    public function getReductionInfo($reduction)
    {
        $homeCC = CostCenter::find($reduction->home_cost_center);
        $reduction->home_cost_center_number = $homeCC->number.' '.$homeCC->extension;
        $reduction->home_cost_center_name = $homeCC->description;
        $homeShift = Shift::find($reduction->home_shift);
        $reduction->home_shift_name = $homeShift->description;
        if($reduction->bump_to_cost_center != null) {
            $bumpToCC = CostCenter::find($reduction->bump_to_cost_center);
            $reduction->bump_to_cost_center_number = $bumpToCC->number.' '.$bumpToCC->extension;
            $reduction->bump_to_cost_center_name = $bumpToCC->description;
        } else {
            $reduction->bump_to_cost_center_number = '';
            $reduction->bump_to_cost_center_name = '';
        }
        if($reduction->bump_to_shift != null) {
            $bumpShift = Shift::find($reduction->bump_to_shift);
            $reduction->bump_to_shift_name = $bumpShift->description;
        } else {
            $reduction->bump_to_shift_name = '';
        }     
    }

    // Convert wage progression event date from string to date
    public function setWageEventDate($employee)
    {
        foreach($employee->wageProgression as $employeeProgression){
            $employeeProgression->pivot->date = $this->setAsDate($employeeProgression->pivot->date);
        }
    }

    // Get employee supervisors
    public function getEmployeeSupervisors($employees) {
        foreach($employees as $employee){
            if($employee->shift->count() > 0){
                foreach($employee->shift as $shift){
                    if($shift->description == 'Day'){
                        $employee->load(
                            'costCenter.employeeDayTeamManager:first_name,last_name',
                            'costCenter.employeeDayTeamLeader:first_name,last_name');
                            foreach($employee->costCenter as $costCenter){
                                foreach($costCenter->employeeDayTeamManager as $teamManager){
                                    $employee->team_manager = $teamManager->first_name.' '.$teamManager->last_name;
                                }
                                foreach($costCenter->employeeDayTeamLeader as $teamLeader){
                                    $employee->team_leader = $teamLeader->first_name.' '.$teamLeader->last_name;
                                }
                            }
                    }elseif($shift->description == 'Night'){
                        $employee->load(
                            'costCenter.employeeNightTeamManager:first_name,last_name',
                            'costCenter.employeeNightTeamLeader:first_name,last_name');
                            foreach($employee->costCenter as $costCenter){
                                foreach($costCenter->employeeDayTeamManager as $teamManager){
                                    $employee->team_manager = $teamManager->first_name.' '.$teamManager->last_name;
                                }
                                foreach($costCenter->employeeDayTeamLeader as $teamLeader){
                                    $employee->team_leader = $teamLeader->first_name.' '.$teamLeader->last_name;
                                }
                            }
                    }else{
                        $employee->load('costCenter');
                        $employee->team_manager = null;
                        $employee->team_leader = null;
                    }
                }
            }else{
                $employee->load('costCenter');
                $employee->team_manager = null;
                $employee->team_leader = null;
            }
        }
    }

}

