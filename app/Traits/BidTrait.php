<?php

namespace App\Traits;

use Carbon\Carbon;

// Models
use App\BidEligibleComment;

trait BidTrait
{

    protected $bidCommentReasons = [
        'hireDate' => 1,
        'updateHireDate' => 2,
        'createDisciplinary' => 3,
        'updateDisciplinary' => 4,
        'deleteDisciplinary' => 5,
        'bidAward' => 6,
        'bidDeny' => 7,
        'bidDisqualify' => 8
    ];

    private function createCommentText($reason, $today, $sixMonthDate, $addComment, $disciplinary)
    {
        switch($reason) {
            case 'hireDate':
                $addComment->comment = $today->format('m/d/Y').' - Employee hired, bid eligible date set to '.$sixMonthDate->format('m/d/Y');
                $addComment->reason = $this->bidCommentReasons[$reason];
                break;
            case 'updateHireDate':
                $addComment->comment = $today->format('m/d/Y').' - Employee hire date adjusted, bid eligible date set to '.$sixMonthDate->format('m/d/Y');
                $addComment->reason = $this->bidCommentReasons[$reason];
                break;
            case 'createDisciplinary':
                $addComment->comment = $today->format('m/d/Y').' - Employee received '.$disciplinary->level.' for '.$disciplinary->type.' on '.$disciplinary->date->format('m/d/Y').', bid eligible date set to '.$sixMonthDate->format('m/d/Y');
                $addComment->reason = $this->bidCommentReasons[$reason];
                break;
            default:
                break;
        }
    }

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
        $addComment = new BidEligibleComment();
        $this->createCommentText('hireDate', $today, $sixMonthDate, $addComment, null);
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
            $sixMonthDate = $newHireDate->copy()->addMonths(6);
            // Check if the new 6 month date is past the current bid_eligible_date
            if($sixMonthDate->lessThanOrEqualTo($employee->bid_eligible_date)){
                // If the new 6 month date is not past the current bid_eligible_date
                $employee->bid_eligible = $request->bid_eligible;
                $employee->bid_eligible_date = $request->bid_eligible_date;
                return $employee;
            }else{
                // If the new 6 month date is past the current bid_eligible_date
                // Set the bid_eligible paramter to 0
                $employee->bid_eligible = 0;
                // Set the bid_eligible_date parameter to the new 6 month date
                $employee->bid_eligible_date = $sixMonthDate;
                // Make a comment in the bid_eligible_comment parameter
                $today = Carbon::today();
                $addComment = new BidEligibleComment();
                $this->createCommentText('updateHireDate', $today, $sixMonthDate, $addComment, null);
                $employee->bidEligibleComment()->save($addComment);
                return $employee;
            }   
        }
    }

    public function setDisciplinaryBidEligibleComment($employee, $disciplinary)
    {
        // Check if disciplinary was a Final, HR Review, or 2nd HR Review
        if($disciplinary->level == 'final' || $disciplinary->level == 'hr review' || $disciplinary->level == '2nd hr review'){
            $sixMonthDate = $disciplinary->date->copy()->addMonths(6);
            $currentBidEligibleDate = $employee->bid_eligible_date;
            $today = Carbon::today();
            if($sixMonthDate->greaterThanOrEqualTo($currentBidEligibleDate)){
                $addComment = new BidEligibleComment();
                $this->createCommentText('updateHireDate', $today, $sixMonthDate, $addComment, $disciplinary);
                $employee->bidEligibleComment()->save($addComment);
                $employee->bid_eligible = 0;
                $employee->bid_eligible_date = $sixMonths;
                $employee->save();
            }
        }
    }

    public function setUpdateDisciplinaryBidEligibleComment()
    {
        // Check if disciplinary was a Final, HR Review, or 2nd HR Review
        if($disciplinary->level == 'final' || $disciplinary->level == 'hr review' || $disciplinary->level == '2nd hr review'){

        }
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

