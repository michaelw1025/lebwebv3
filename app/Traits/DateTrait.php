<?php

namespace App\Traits;

use Carbon\Carbon;

trait DateTrait
{
    protected function setAsDate($date)
    {
        return Carbon::parse($date);
    }

}

