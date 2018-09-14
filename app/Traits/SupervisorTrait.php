<?php

namespace App\Traits;

// Models
use App\Employee;

trait SupervisorTrait
{
    protected function getEmployeeSupervisors($employee) {
        if($employee->shift->count() > 0){
            foreach($employee->shift as $shift){
                if($shift->description == 'Day'){
                    foreach($employee->costCenter as $costCenter){
                        foreach($costCenter->employeeDayTeamManager as $teamManager){
                            $employee->team_manager = $teamManager->first_name.' '.$teamManager->last_name;
                        }
                        foreach($costCenter->employeeDayTeamLeader as $teamLeader){
                            $employee->team_leader = $teamLeader->first_name.' '.$teamLeader->last_name;
                        }
                    }
                }elseif($shift->description == 'Night'){
                    foreach($employee->costCenter as $costCenter){
                        foreach($costCenter->employeeNightTeamManager as $teamManager){
                            $employee->team_manager = $teamManager->first_name.' '.$teamManager->last_name;
                        }
                        foreach($costCenter->employeeNightTeamLeader as $teamLeader){
                            $employee->team_leader = $teamLeader->first_name.' '.$teamLeader->last_name;
                        }
                    }
                }else{
                    $employee->team_manager = null;
                    $employee->team_leader = null;
                }
            }
        }else{
            $employee->team_manager = null;
            $employee->team_leader = null;
        }
        return $employee;
    }

    protected function getAllSupervisors()
    {
        $supervisors = Employee::select(
            'id',
            'first_name',
            'last_name'
        )
        ->where('status', 1)
        ->whereHas('job', function($q) {
            $q->where('description', 'salary');
        })
        ->orWhereHas('position', function($q) {
            $q->where('description', 'specialist operations');
        })
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $supervisors;
    }

    protected function getAllTeamLeaders()
    {
        $teamLeader = Employee::has('costCenterDayTeamLeader')
        ->orHas('costCenterNightTeamLeader')
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $teamLeader;
    }

    protected function getSalariedWithOS()
    {
        $salariedEmployees = Employee::whereHas('job', function($q) {
            $q->where('description', 'salary');
        })
        ->orWhereHas('position', function($q) {
            $q->where('description', 'specialist operations');
        })
        ->orderBy('last_name', 'asc')
        ->orderBy('first_name', 'asc')
        ->get();
        return $salariedEmployees;
    }

}

