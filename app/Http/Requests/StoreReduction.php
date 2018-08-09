<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReduction extends FormRequest
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
        $rulesArray = [];

        $rulesArray += [
            'currently_active' => 'required',
            'type' => 'required',
            'displacement' => 'required',
            'date' => 'required|date',
            'home_cost_center' => 'required',
            'bump_to_cost_center' => 'required_if:displacement,bump',
            'home_shift' => 'required',
            'bump_to_shift' => 'required_if:displacement,bump',
            'fiscal_week' => 'required|numeric',
            'fiscal_year' => 'required|numeric',
            'return_date' => 'nullable|date',
            'comments' => 'required'
        ];

        return $rulesArray;
    }
}
