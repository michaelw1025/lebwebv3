<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

// Rules
use App\Rules\CostCenterNumber;

class StoreCostCenter extends FormRequest
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
        if($this->route()->named('costCenters.store')) { // If storing a new cost center
            // Set id to null to prevent error when calling custom rule
            $id = null;
        }else { // If updating a cost center
            // Get cc id from route
            $id = $this->route('costCenter');
        }

        return [
            'number' => ['required', new CostCenterNumber($id, $this->extension)],
            'staff_manager' => 'required',
            'day_team_manager' => 'required',
            'night_team_manager' => 'required',
            'day_team_leader' => 'required',
            'night_team_leader' => 'required'
        ];
    }
}
