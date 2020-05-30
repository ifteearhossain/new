<?php

namespace App\Http\Requests\TocRequests;

use Illuminate\Foundation\Http\FormRequest;

class TocFormRequests extends FormRequest
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
            'toc_heading' => 'required|unique:tocs',
            'toc_details' => 'required',
        ];
    }
}
