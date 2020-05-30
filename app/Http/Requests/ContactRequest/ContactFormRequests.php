<?php

namespace App\Http\Requests\ContactRequest;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequests extends FormRequest
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
           'name'     => 'required',
           'email'    => 'required',
           'subject'  => 'required|min:10',
           'message'  => 'required|min:50',
        ];
    }
}
