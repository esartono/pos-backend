<?php

namespace App\Http\Requests\Voucher;

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
            'type' => 'required|integer|between:1,2',
            'arise_at' => 'required|date_format:"Y-m-d H:i:s"',
            'recipient_name' => 'required|string',
            'reason' => 'required|string',
            'amount' => 'required|integer',
            'description' => 'nullable',
        ];

    }
}
