<?php

namespace App\Http\Requests\Sale;

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
            'customer_id' => 'required|integer',
            'sale_at' => 'required|date_format:"Y-m-d H:i:s"',
            'description' => 'nullable',
            'sale_items.*.id' => 'integer',
            'sale_items.*.product_id' => 'required|integer',
            'sale_items.*.unit_id' => 'required|integer',
            'sale_items.*.quantity' => 'required|integer',
            'sale_items.*.price' => 'required|integer',
            'sale_items.*.description' => 'nullable',
        ];

    }
}
