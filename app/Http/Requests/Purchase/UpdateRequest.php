<?php

namespace App\Http\Requests\Purchase;

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
            'supplier_id' => 'required|integer',
            'purchase_at' => 'required|date_format:"Y-m-d H:i:s"',
            'description' => 'nullable',
            'purchase_items.*.product_id' => 'required|integer',
            'purchase_items.*.unit_id' => 'required|integer',
            'purchase_items.*.quantity' => 'required|integer',
            'purchase_items.*.price' => 'required|integer',
            'purchase_items.*.description' => 'nullable',
        ];

    }
}
