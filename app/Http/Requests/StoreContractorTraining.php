<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractorTraining extends FormRequest
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
        $rulesArray = [];

        if($this->route()->named('contractorTrainings.store')) { // If storing a new contractor employee
            $rulesArray += [
                'contractor_employee_name' => 'required|string|max:50|unique:contractor_trainings'
            ];
        }else { // If updating a contractor employee
            // Get contractor employee id from route
            $id = $this->route('contractorTraining');
            $rulesArray += [
                'contractor_employee_name' => 'required|string|max:50|unique:contractor_trainings,contractor_employee_name,'.$id
            ];
        }

        return $rulesArray;
    }
}
