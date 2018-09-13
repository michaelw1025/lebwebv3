<?php

namespace App\Traits;

// Models
use App\CostCenter;

trait CostCenterTrait
{
    protected function getCostCentersAll()
    {
        $costCenters = CostCenter::orderBy('number', 'asc')->orderBy('extension', 'asc')
        ->with([
            'employeeStaffManager',
            'employeeDayTeamManager', 
            'employeeNightTeamManager', 
            'employeeDayTeamLeader',
            'employeeNightTeamLeader'
        ])->get();
        return $costCenters;
    }

    protected function setCostCenterLeaders($costCenter)
    {
        // Set staff manager
        if(isset($costCenter->employeeStaffManager)){
            foreach($costCenter->employeeStaffManager as $staffManager){
                $costCenter->staff_manager = $staffManager->first_name.' '.$staffManager->last_name;
            }
        }
        else{
            $costCenter->staff_manager = '';
        }
        // Set day team manager
        if(isset($costCenter->employeeDayTeamManager)){
            foreach($costCenter->employeeDayTeamManager as $dayManager){
                $costCenter->day_manager = $dayManager->first_name.' '.$dayManager->last_name;
            }
        }else{
            $costCenter->day_manager = '';
        }
        // Set day team leader
        if(isset($costCenter->employeeDayTeamLeader)){
            foreach($costCenter->employeeDayTeamLeader as $dayLeader){
                $costCenter->day_leader = $dayLeader->first_name.' '.$dayLeader->last_name;
            }
        }else{
            $costCenter->day_leader = '';
        }
        // Set night team manager
        if(isset($costCenter->employeeNightTeamManager)){
            foreach($costCenter->employeeNightTeamManager as $nightManager){
                $costCenter->night_manager = $nightManager->first_name.' '.$nightManager->last_name;
            }
        }else{
            $costCenter->night_manager = '';
        }
        // Set night team leader
        if(isset($costCenter->employeeNightTeamLeader)){
            foreach($costCenter->employeeNightTeamLeader as $nightLeader){
                $costCenter->night_leader = $nightLeader->first_name.' '.$nightLeader->last_name;
            }
        }else{
            $costCenter->night_leader = '';
        }
        return $costCenter;
    }

}

