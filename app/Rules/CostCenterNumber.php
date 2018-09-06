<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

// Models
use App\CostCenter;

class CostCenterNumber implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id, $extension)
    {
        $this->id = $id;
        $this->extension = $extension;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!empty($value)){
            $duplicate = CostCenter::where('number', $value)->where('extension', $this->extension)->first();
            if($duplicate){
                if($duplicate->id == $this->id){
                    return true;
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The CC number already exists with the chosen extension.';
    }
}
