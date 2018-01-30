<?php

namespace App\Http\Requests\User;

use Dingo\Api\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            'password'         => 'required|min:8:max:16|alphanumeric',
            'password_confirmation' => 'required|same:password',
        ];

    }

    public function messages()
    {
        return [
            'password.required'     => __('custom_validation.password_required'),
            'password.min'          => __('custom_validation.password_min_eight_charater'),
            'password.max'          => __('custom_validation.password_max_sixteen_character'),
            'password.alphanumeric' => __('custom_validation.password_must_be_alphanumeric'),
            'password_confirmation.required' => __('custom_validation.password_confirm_required'),
            'password_confirmation.same' => __('custom_validation.password_confirm_must_be_same_password'),
        ];
    }
}
