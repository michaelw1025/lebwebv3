<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBid extends FormRequest
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
        $resultsArray = [];

        if($this->route()->named('bidding.store')) { // If storing a new bid
            $resultsArray += [
                'posting_number' => 'required|unique:bids'
            ];
        }else { // If updating a bid
            // Get bid id from route
            $id = $this->route('bid');
            $resultsArray += [
                'posting_number' => 'required|unique:bids,posting_number,'.$id
            ];
        }

        $resultsArray += [
            'post_date' => 'required|date',
            'pull_date' => 'required|date|after:post_date',
            'team_id' => 'required',
            'position_id' => 'required',
            'shift_id' => 'required',
            'number_of_openings' => 'required|int',
            'top_wage_id' => 'required',
            'top_wage_with_education_id' => 'required',
            'education_requirement' => 'nullable|boolean',
            'resume_required' => 'nullable|boolean',
            'tech_form_required' => 'nullable|boolean',
            'summary' => 'required',
            'essential_duties_responsibilities' => 'required',
            'qualifications' => 'required',
            'successful_bidder' => 'required',
            'education_experience' => 'required',
            'physical_demands' => 'required'
        ];

        return $resultsArray;
    }
}
