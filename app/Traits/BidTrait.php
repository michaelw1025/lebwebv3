<?php

namespace App\Traits;

use Carbon\Carbon;

// Models
use App\BidEligibleComment;

trait BidTrait
{
    // public function setEmployeeBidEligibility($actionType, $newEmployee, $oldEmployee)
    // {
    //     // If an employee is being created
    //     switch($actionType) {
    //         case 'employee-create':
    //             // Get the hire date for the employee
    //             $hireDate = $newEmployee->hire_date;
    //             // Get the date 6 months from the hire date
    //             $sixMonthDate = $hireDate->copy()->addMonths(6);
    //             // Set the bid_eligible property to 0
    //             $newEmployee->bid_eligible = 0;
    //             // Set the bid_eligible_date property to the 6 month date
    //             $newEmployee->bid_eligible_date = $sixMonthDate;
    //             // Add a comment to the bid_eligible_comment
    //             // $newEmployee->bid_eligible_comment = $hireDate->format('m/d/Y').' - Employee hired, bid eligible date set to '.$sixMonthDate->format('m/d/Y').';';
    //             return $newEmployee;
    //             break;
    //         case 'employee-after-create':
    //             // Get the hire date for the employee
    //             $hireDate = $newEmployee->hire_date;
    //             // Get the date 6 months from the hire date
    //             $sixMonthDate = $hireDate->copy()->addMonths(6);
    //             // Set the commnet to add
    //             $addComment = $hireDate->format('m/d/Y').' - Employee hired, bid eligible date set to '.$sixMonthDate->format('m/d/Y');
    //             $newEmployee->bidEligibleComment()->save($addComment);
    //             break;
    //         case 'employee-update':
    //             // Get the current hire date
    //             $currentHireDate = $oldEmployee->hire_date;
    //             // Get the new hire date
    //             $newHireDate = Carbon::parse($newEmployee->hire_date);
    //             // Check if the new and current hire dates match
    //             if($currentHireDate->equalTo($newHireDate)){
    //                 // If the new and current hire dates do match
    //                 // Take no action
    //             }else{
    //                 // If the new and current hire dates do not match
    //                 // Get the new 6 month date
    //                 $newSixMonthDate = $newHireDate->copy()->addMonths(6);
    //                 // Check if the new 6 month date is past the current bid_eligible_date
    //                 if($newSixMonthDate->lessThanOrEqualTo($oldEmployee->bid_eligible_date)){
    //                     // If the new 6 month date is not past the current bid_eligible_date
    //                     // Take no action
    //                 }else{
    //                     // If the new 6 month date is past the current bid_eligible_date
    //                     // Set the bid_eligible paramter to 0
    //                     $oldEmployee->bid_eligible = 0;
    //                     // Set the bid_eligible_date parameter to the new 6 month date
    //                     $oldEmployee->bid_eligible_date = $newSixMonthDate;
    //                     // Make a comment in the bid_eligible_comment parameter
    //                     $now = Carbon::today();
    //                     $commentParameter = $now->format('m/d/Y').' - Employee hire date adjusted, bid eligible date set to '.$newSixMonthDate->format('m/d/Y');
    //                     $addComment = new BidEligibleComment();
    //                     $addComment->comment = $commentParameter;
    //                     $oldEmployee->bidEligibleComment()->save($addComment);
    //                     return $oldEmployee;
    //                 }
                        
    //             }
    //             break;
                
    //         default:
    //             return true;
    //     }

    // }

    public function setCreateEmployeeBidEligibility($request, $employee)
    {
        // Get today
        $today = Carbon::today();
        // Get the hire date for the employee
        $hireDate = $employee->hire_date;
        // Get the date 6 months from the hire date
        $sixMonthDate = $hireDate->copy()->addMonths(6);
        // Set the bid_eligible property to 0
        $employee->bid_eligible = 0;
        // Set the bid_eligible_date property to the 6 month date
        $employee->bid_eligible_date = $sixMonthDate;
        return $employee;
    }

    public function setAfterCreateEmployeeBidEligiblility($request, $employee)
    {
        // Get today
        $today = Carbon::today();
        // Get the hire date for the employee
        $hireDate = $employee->hire_date;
        // Get the date 6 months from the hire date
        $sixMonthDate = $hireDate->copy()->addMonths(6);
        $comment = $today->format('m/d/Y').' - Employee hired, bid eligible date set to '.$sixMonthDate->format('m/d/Y');
        $addComment = new BidEligibleComment();
        $addComment->comment = $comment;
        $employee->bidEligibleComment()->save($addComment);
    }

    public function setUpdateEmployeeBidEligibility($request, $employee)
    {
        // Get the current hire date
        $currentHireDate = $employee->hire_date;
        // Get the new hire date
        $newHireDate = Carbon::parse($request->hire_date);
        // Check if the new and current hire dates match
        if($currentHireDate->equalTo($newHireDate)){
            // If the new and current hire dates do match
            $employee->bid_eligible = $request->bid_eligible;
            $employee->bid_eligible_date = $request->bid_eligible_date;
            return $employee;
        }else{
            // If the new and current hire dates do not match
            // Get the new 6 month date
            $newSixMonthDate = $newHireDate->copy()->addMonths(6);
            // Check if the new 6 month date is past the current bid_eligible_date
            if($newSixMonthDate->lessThanOrEqualTo($employee->bid_eligible_date)){
                // If the new 6 month date is not past the current bid_eligible_date
                $employee->bid_eligible = $request->bid_eligible;
                $employee->bid_eligible_date = $request->bid_eligible_date;
                return $employee;
            }else{
                // If the new 6 month date is past the current bid_eligible_date
                // Set the bid_eligible paramter to 0
                $employee->bid_eligible = 0;
                // Set the bid_eligible_date parameter to the new 6 month date
                $employee->bid_eligible_date = $newSixMonthDate;
                // Make a comment in the bid_eligible_comment parameter
                $today = Carbon::today();
                $comment = $today->format('m/d/Y').' - Employee hire date adjusted, bid eligible date set to '.$newSixMonthDate->format('m/d/Y');
                $addComment = new BidEligibleComment();
                $addComment->comment = $comment;
                $employee->bidEligibleComment()->save($addComment);
                return $employee;
            }   
        }
    }

    public function setDisciplinaryBidEligibleComment($employee, $disciplinary)
    {
        // Check if disciplinary was a Final, HR Review, or 2nd HR Review
        if($disciplinary->level == 'final' || $disciplinary->level == 'hr review' || $disciplinary->level == '2nd hr review'){
            $disciplinaryDate = $disciplinary->date;
            $disciplinaryType = $disciplinary->type;
            $disciplinaryLevel = $disciplinary->level;
            $sixMonths = $disciplinaryDate->copy()->addMonths(6);
            $currentBidEligibleDate = $employee->bid_eligible_date;
            $today = Carbon::today();
            if($sixMonths->greaterThanOrEqualTo($currentBidEligibleDate)){
                $comment = $today->format('m/d/Y').' - Employee received '.$disciplinaryLevel.' for '.$disciplinaryType.' on '.$disciplinaryDate->format('m/d/Y').', bid eligible date set to '.$sixMonths->format('m/d/Y');
                $addComment = new BidEligibleComment();
                $addComment->comment = $comment;
                $employee->bidEligibleComment()->save($addComment);
                $employee->bid_eligible = 0;
                $employee->bid_eligible_date = $sixMonths;
                $employee->save();
            }
        }
    }

    public function setUpdateDisciplinaryBidEligibleComment()
    {

    }

    public function setDeleteDisciplinaryBidEligibleComment($disciplinary)
    {
        // Get the employee
        $employee = Employee::findOrFail($disciplinary->employee_id);
        // Determine if deleting this disciplinary will affect the bid eligible date
        // Get current bid eligible date
        $currentBidEligibleDate = $employee->bid_eligible_date;
        // Get this disciplinarie's date
        $disciplinaryDate = $disciplinary->date;
        // Get 6 months from this disciplinarie's date
        $sixMonths = $disciplinaryDate->copy()->addMonths(6);
        if($currentBidEligibleDate->equalTo($sixMonths)){
            // If the current bid eligible date is equal to the disciplinarie's six month date

            // Check if another disciplinary will affect the bid eligible date

            // Check if the hire date will adjust the bid eligible date

            // Check if a bid award will affect the bid eligible date

            // Check if a bid denial will affect the bid eligible date
        }else{
            // If the current bid eligible date is NOT equal to the disciplinarie's six month date
        }
    }

}

