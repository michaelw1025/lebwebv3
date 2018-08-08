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
            'position' => 'required',
            'job' => 'required',
            'phone_number.*.number' => 'nullable|size:12',
            // 'emergency_contact.*.number' => 'nullable|size:12',
            // 'emergency_contact.*.name' => 'required_with:emergency_contact.*.name|string|max:35'
        ];

        // Check emergency contacts
        if($this->has('emergency_contact')) {
            $eCCount = 1;
            foreach($this->emergency_contact as $eC) {
                if($eC['number'] !== null){
                    $rulesArray += [
                        'emergency_contact.'.$eCCount.'.number' => 'size:12',
                        'emergency_contact.'.$eCCount.'.name' => 'required|string|max:35'
                    ];
                } elseif($eC['name'] !== null) {
                    $rulesArray += [
                        'emergency_contact.'.$eCCount.'.number' => 'required|size:12',
                        'emergency_contact.'.$eCCount.'.name' => 'string|max:35'
                    ];
                }
                $eCCount++;
            }
        }

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

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'phone_number.*.number.size' => 'The phone number field must be 12 characters including dashes.',
            'emergency_contact.*.number.required' => 'The emergency contact number field cannot be blank if a name is given.',
            'emergency_contact.*.number.size' => 'The emergency contact number field must be 12 characters including dashes.',
            'emergency_contact.*.name.required' => 'The emergency contact name field cannot be blank if a number is given.',
        ];
    }
}
