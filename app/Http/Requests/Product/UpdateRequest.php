<?php

namespace App\Http\Requests\Product;

use Dingo\Api\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'retail_price' => 'required|integer',
            'wholesale_price' => 'integer|nullable',
            'featured_image' => 'mimes:jpg,jpeg,png,gif|nullable',
            'description' => 'nullable',
        ];

    }
}
