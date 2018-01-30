<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'token'            => 'required',
            'password'         => 'required|min:8:max:16|alphanumeric',
            'password_confirmation' => 'required|same:password',
            'email'            => 'required',
        ];

    }

    public function messages()
    {
        return [
            'token.required'        => __('custom_validation.token_reset_required'),
            'password.required'     => __('custom_validation.password_required'),
            'password.min'          => __('custom_validation.password_min_eight_charater'),
            'password.max'          => __('custom_validation.password_max_sixteen_character'),
            'password.alphanumeric' => __('custom_validation.password_must_be_alphanumeric'),
            'password_confirmation.required' => __('custom_validation.password_confirm_required'),
            'password_confirmation.same' => __('custom_validation.password_confirm_must_be_same_password'),
            'email.required'        => __('custom_validation.email_required'),
        ];
    }
}
