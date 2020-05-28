<?php

namespace App\Http\Requests\PolicyRequests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyFormRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'policy_heading' => 'required|unique:policies',
            'policy_details' => 'required',
        ];
    }
}
