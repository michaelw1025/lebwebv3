<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContractor extends FormRequest
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

        if($this->route()->named('contractors.store')) { // If storing a new contractor
            $rulesArray += [
                'contractor_name' => 'required|string|max:50|unique:contractors'
            ];
        }else { // If updating a contractor
            // Get contractor id from route
            $id = $this->route('contractor');
            $rulesArray += [
                'contractor_name' => 'required|string|max:50|unique:contractors,contractor_name,'.$id
            ];
        }

        $rulesArray += [
            'contact_name' => 'nullable|string|max:50',
            'contact_email' => 'nullable|email'
        ];

        return $rulesArray;
    }
}
