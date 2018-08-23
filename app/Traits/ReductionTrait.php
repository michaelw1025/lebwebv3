<?php

namespace App\Traits;

// Models
use App\CostCenter;
use App\Shift;

trait ReductionTrait
{
    // Get reduction info
    protected function getReductionInfo($reduction)
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

}

