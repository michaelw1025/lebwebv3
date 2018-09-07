<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWageProgression extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Check if user is authorized to access this page
        if($this->user()->authorizeRoles(['admin', 'hrmanager', 'hruser'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rulesArray = array();

        if($this->route()->named('wageProgressions.store')) { // If storing a new wage progression
            $rulesArray += [
                'month' => 'required|numeric|max:100|unique:wage_progressions'
            ];
        }else { // If updating a wage progression
            // Get wage progression id from route
            $id = $this->route('wageProgression');
            $rulesArray += [
                'month' => 'required|numeric|max:100|unique:wage_progressions,month,'.$id
            ];
        }

        $rulesArray += [

        ];

        return $rulesArray;

    }
}
