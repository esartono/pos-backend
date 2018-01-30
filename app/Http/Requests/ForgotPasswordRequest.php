<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email'    => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required'        => __('custom_validation.email_required'),
            'email.email'           => __('custom_validation.email_format'),
        ];
    }
}
