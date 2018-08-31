<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchEmployeeTurnover extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Check if user is authorized to access this page
        if($this->user()->authorizeRoles(['admin', 'hrmanager', 'hruser', 'hrassistant'])) {
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
        // Check if search form is being submitted
        if($this->has('start_date') && $this->has('end_date')){
            return [
                'start_date' => 'required',
                'end_date' => 'required'
            ];
        }else{
            return [];
        }
    }
}
