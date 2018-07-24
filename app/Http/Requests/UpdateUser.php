<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        $id = $this->route('user');

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required',
        ];
    }

    /**
     * Get the custom error mesages
     * 
     */
    public function messages()
    {
        return [
            'first_name.required' => 'First name cannot be blank.',
            'first_name.string' => 'First name must be formatted as a string.',
            'first_name.max' => 'First name exceeded the max number of characters.',
            'last_name.required' => 'Last name cannot be blank.',
            'last_name.string' => 'Last name must be formatted as a string.',
            'last_name.max' => 'Last name exceeded the max number of characters.',
            'email.required' => 'Email cannot be blank.',
            'email.string' => 'Email name must be formatted as a string.',
            'email.email' => 'Email must be formatted as a valid email address',
            'email.max' => 'Email exceeded the max number of characters.',
        ];
    }
}
