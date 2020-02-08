<?php

namespace WimmCMS\core\Http\Requests;

use WimmCMS\core\Http\Requests\API\FormRequest;

class StoreAboutRequest extends FormRequest
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
            'name' => 'required|min:2|max:100',
            'displayName' => 'required',
            'description' => 'required|min:50|max:170',
            'thumbnail' => 'required|image',
        ];
    }
}
