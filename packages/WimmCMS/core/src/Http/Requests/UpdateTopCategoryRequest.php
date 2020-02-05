<?php

namespace WimmCMS\core\Http\Requests;

use WimmCMS\core\Http\Requests\API\FormRequest;

class UpdateTopCategoryRequest extends FormRequest
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
            'title' => 'required|min:2|max:100',
            'description' => 'required|min:20',
            'thumbnail' => 'image',
            'has_page' => 'required',
            'is_private' => 'required',
            'show_in_navigation' => 'required',
            'show_in_footer' => 'required'
        ];
    }
}
