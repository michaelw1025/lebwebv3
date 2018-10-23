<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

// Models
use App\Employee;
use App\BidEligibleComment;

class UpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Set by hire date
        // $employees = Employee::get();
        // foreach($employees as $employee){
        //     // Get hire date
        //     $hireDate = $employee->hire_date;
        //     // Get 6 month date
        //     $sixMonth = $hireDate->copy()->addMonths(6);
        //     // Get today
        //     $today = Carbon::today();
        //     // Check if 6 month date is later than today
        //     if($sixMonth->lessThanOrEqualTo($today)){
        //         // If the new 6 month date is not past today
        //         $employee->bid_eligible = 1;
        //         $employee->bid_eligible_date = $sixMonth;
        //     }else{
        //         // If the new 6 month date is past today
        //         $employee->bid_eligible = 0;
        //         $employee->bid_eligible_date = $sixMonth;
        //     }
        //     $employee->save();
        //     $comment = $today->format('m/d/Y').' - Initial bid eligible date set to '.$sixMonth->format('m/d/Y').';';
        //     $addComment = new BidEligibleComment();
        //     $addComment->comment = $comment;
        //     $employee->bidEligibleComment()->save($addComment);
        // }

        // Set by disciplinary
        // Get today
        $today = Carbon::today();
        // Get six months ago from today
        $sixMonthsAgo = $today->copy()->subMonths(6);
        // Get all employees with disciplinaries
        $employees = Employee::whereHas('disciplinary', function($q) {
            $q->where('level', 'final')->orWhere('level', 'hr review')->orwhere('level', '2nd hr review');
        })
        ->get();
        foreach($employees as $employee){
            // Get the current bid_eligible_date
            $bidEligibleDate = $employee->bid_eligible_date;
            foreach($employee->disciplinary as $disciplinary){
                // Check to make sure the disciplinary is the correct level
                if($disciplinary->level == 'final' || $disciplinary->level == 'hr review' || $disciplinary->level == '2nd hr review'){
                    // Check if 6 months from the disciplinary date is greater than the current bid eligible date
                    if($disciplinary->date->addMonths(6)->greaterThanOrEqualTo($bidEligibleDate)){
                        // If the disciplinary date is greater than the current bid eligible date
                        // Check if the disciplinary date is greater than six months ago from today
                        if($disciplinary->date->addMonths(6)->greaterThanOrEqualTo($sixMonthsAgo)){
                            // If the disciplinary date is greater than six months ago from today
                        }else{
                            // If the disciplinary date is not greater than six months ago from today
                        }
                    }else{
                        // If the discplinary date is not greater than the current bid eligible date
                        // Take no action
                    }
                }
            }
        }
        
    }
}
