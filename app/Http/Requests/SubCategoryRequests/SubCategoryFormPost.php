<?php

namespace App\Http\Requests\SubCategoryRequests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryFormPost extends FormRequest
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
            'sub_category_name' => 'required|unique:sub_categories',
            'category_id'       => 'required',
        ];
    }
}
