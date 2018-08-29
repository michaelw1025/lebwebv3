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

    protected function setCostCenterLeaders($costCenters)
    {
        foreach($costCenters as $costCenter){
            // Set staff manager
            foreach($costCenter->employeeStaffManager as $staffManager){
                $costCenter->staff_manager = $staffManager->first_name.' '.$staffManager->last_name;
            }
            // Set day team manager
            foreach($costCenter->employeeDayTeamManager as $dayManager){
                $costCenter->day_manager = $dayManager->first_name.' '.$dayManager->last_name;
            }
            // Set day team leader
            foreach($costCenter->employeeDayTeamLeader as $dayLeader){
                $costCenter->day_leader = $dayLeader->first_name.' '.$dayLeader->last_name;
            }
            // Set night team manager
            foreach($costCenter->employeeNightTeamManager as $nightManager){
                $costCenter->night_manager = $nightManager->first_name.' '.$nightManager->last_name;
            }
            // Set night team leader
            foreach($costCenter->employeeNightTeamLeader as $nightLeader){
                $costCenter->night_leader = $nightLeader->first_name.' '.$nightLeader->last_name;
            }
            unset($costCenter->employeeStaffManager);
            unset($costCenter->employeeDayTeamManager);
            unset($costCenter->employeeDayTeamLeader);
            unset($costCenter->employeeNightTeamManager);
            unset($costCenter->employeeNightTeamLeader);
        }
        return $costCenters;
    }

}

