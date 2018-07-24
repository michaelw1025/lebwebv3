<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRole extends FormRequest
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
        if($this->route()->named('roles.store')) { // If storing a new role
            return [
                'description' => 'required|string|max:255',
                'name' => 'required|string|max:255|unique:roles,name'
            ];
        }elseif($this->route()->name('roles.update')) {
            // Get role id from route
            $id = $this->route('role');
            return [
                'description' => 'required|string|max:255',
                'name' => 'required|string|max:255|unique:roles,name,'.$id
            ];
        }else {
            
        }
        
    }

    /**
     * Get the custom error mesages
     * 
     */
    public function messages()
    {
        return [
            'description.required' => 'Description cannot be blank.',
            'description.string' => 'Description must be formatted as a string.',
            'description.max' => 'Description exceeded the max number of characters.',
            'name.required' => 'Name cannot be blank.',
            'name.string' => 'Name must be formatted as a string.',
            'name.max' => 'Name exceeded the max number of characters.',
            'name.unique' => 'Name must be unique.',
        ];
    }


}
