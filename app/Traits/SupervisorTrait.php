<?php

namespace App\Traits;

// Models
use App\Employee;

trait SupervisorTrait
{
    // Get employee supervisors
    protected function getEmployeeSupervisors($employees) {
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
                                foreach($costCenter->employeeNightTeamManager as $teamManager){
                                    $employee->team_manager = $teamManager->first_name.' '.$teamManager->last_name;
                                }
                                foreach($costCenter->employeeNightTeamLeader as $teamLeader){
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
        return $employees;
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

}

