<?php

namespace App\Traits;

trait StateTrait
{
    // Sets the state name based on model abbreviation
    protected function checkState($employee)
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

}

