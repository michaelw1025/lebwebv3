<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployee extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //Check if user is authorized to access this page
        if($this->user()->authorizeRoles(['admin'])) {
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
        // Get user id from route
        $id = $this->route('employee');

        $rulesArray = [];

        $rulesArray += [
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:50',
            'middle_initial' => 'nullable|string|max:4',
            'birth_date' => 'required',
            'hire_date' => 'required',
            'service_date' => 'required',
            'maiden_name' => 'nullable|string|max:50',
            'nick_name' => 'nullable|string|max:50',
            'gender' => 'required',
            'suffix' => 'nullable|max:10',
            'address_1' => 'required|max:255',
            'address_2' => 'nullable|max:255',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:2',
            'zip_code' => 'required|max:15',
            'county' => 'required|string|max:25',
            'photo_link' => 'nullable|image',
            'cost_center' => 'required',
            'shift' => 'required',
        ];

        if($this->route()->named('employees.store')) { // If storing a new employee
            $rulesArray += [
                'ssn' => 'required|unique:employees', 
                'oracle_number' => 'nullable|unique:employees',
            ];
        }else { // If updating an employee
            $rulesArray += [
                'ssn' => 'required|unique:employees,ssn,'.$id,
                'oracle_number' => 'nullable|unique:employees,oracle_number,'.$id,
                'status' => 'required|boolean',
                'rehire' => 'required|boolean',
                'thirty_day_review' => 'nullable|boolean',
                'sixty_day_review' => 'nullable|boolean'
            ];
        }

        return $rulesArray;
    }
}
