<?php

namespace App\Traits;

trait HelperFunctions
{
    public function checkState ($employee)
    {
        switch($employee->state) {
            case 'al':
                $employee->stateFullName = 'Alabama';
                break;
            case 'ak': 
                $employee->stateFullName = 'Alaska';
                break;
            case 'az': 
                $employee->stateFullName = 'Arizona';
                break;
            case 'ar': 
                $employee->stateFullName = 'Arkansas';
                break;
            case 'ca': 
                $employee->stateFullName = 'California';
                break;
            case 'co': 
                $employee->stateFullName = 'Colorado';
                break;
            case 'ct': 
                $employee->stateFullName = 'Connecticut';
                break;
            case 'de': 
                $employee->stateFullName = 'Delaware';
                break;
            case 'dc': 
                $employee->stateFullName = 'District Of Columbia';
                break;
            case 'fl': 
                $employee->stateFullName = 'Florida';
                break;
            case 'ga': 
                $employee->stateFullName = 'Georgia';
                break;
            case 'hi': 
                $employee->stateFullName = 'Hawaii';
                break;
            case 'id': 
                $employee->stateFullName = 'Idaho';
                break;
            case 'il': 
                $employee->stateFullName = 'Illinois';
                break;
            case 'in': 
                $employee->stateFullName = 'Indiana';
                break;
            case 'ia': 
                $employee->stateFullName = 'Iowa';
                break;
            case 'ks': 
                $employee->stateFullName = 'Kansas';
                break;
            case 'ky': 
                $employee->stateFullName = 'Kentucky';
                break;
            case 'la': 
                $employee->stateFullName = 'Louisiana';
                break;
            case 'me': 
                $employee->stateFullName = 'Maine';
                break;
            case 'md': 
                $employee->stateFullName = 'Maryland';
                break;
            case 'ma': 
                $employee->stateFullName = 'Massachusetts';
                break;
            case 'mi': 
                $employee->stateFullName = 'Michigan';
                break;
            case 'mn': 
                $employee->stateFullName = 'Minnesota';
                break;
            case 'ms': 
                $employee->stateFullName = 'Mississippi';
                break;
            case 'mo': 
                $employee->stateFullName = 'Missouri';
                break;
            case 'mt': 
                $employee->stateFullName = 'Montana';
                break;
            case 'ne': 
                $employee->stateFullName = 'Nebraska';
                break;
            case 'nv': 
                $employee->stateFullName = 'Nevada';
                break;
            case 'nh': 
                $employee->stateFullName = 'New Hampshire';
                break;
            case 'nj': 
                $employee->stateFullName = 'New Jersey';
                break;
            case 'nm': 
                $employee->stateFullName = 'New Mexico';
                break;
            case 'ny': 
                $employee->stateFullName = 'New York';
                break;
            case 'nc': 
                $employee->stateFullName = 'North Carolina';
                break;
            case 'nd': 
                $employee->stateFullName = 'North Dakota';
                break;
            case 'oh': 
                $employee->stateFullName = 'Ohio';
                break;
            case 'ok': 
                $employee->stateFullName = 'Oklahoma';
                break;
            case 'or': 
                $employee->stateFullName = 'Oregon';
                break;
            case 'pa': 
                $employee->stateFullName = 'Pennsylvania';
                break;
            case 'ri': 
                $employee->stateFullName = 'Rhode Island';
                break;
            case 'sc': 
                $employee->stateFullName = 'South Carolina';
                break;
            case 'sd': 
                $employee->stateFullName = 'South Dakota';
                break;
            case 'tn': 
                $employee->stateFullName = 'Tennessee';
                break;
            case 'tx': 
                $employee->stateFullName = 'Texas';
                break;
            case 'ut': 
                $employee->stateFullName = 'Utah';
                break;
            case 'vt': 
                $employee->stateFullName = 'Vermont';
                break;
            case 'va': 
                $employee->stateFullName = 'Virginia';
                break;
            case 'wa': 
                $employee->stateFullName = 'Washington';
                break;
            case 'wv': 
                $employee->stateFullName = 'West Virginia';
                break;
            case 'wi': 
                $employee->stateFullName = 'Wisconsin';
                break;
            case 'wy': 
                $employee->stateFullName = 'Wyoming';
                break;
            default:
                $employee->stateFullName = '';
        }           
    }








}

