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
        $employees = Employee::get();
        
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
    }
}
