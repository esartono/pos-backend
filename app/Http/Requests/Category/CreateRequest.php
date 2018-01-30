<?php

namespace App\Http\Requests\Category;

use Dingo\Api\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'parent_id' => 'integer|nullable',
            'name' => 'required|string',
            'description' => 'nullable',
        ];

    }
}
