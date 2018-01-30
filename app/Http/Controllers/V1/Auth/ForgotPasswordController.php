<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try {
            $response = $this->broker()->sendResetLink(
                $request->only('email')
            );

            if ($response == Password::RESET_LINK_SENT) {
                return $this->responseSuccess();
            }
            return $this->responseError(__('messages.something_went_wrong'), 500);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function broker()
    {
        return Password::broker();
    }

}
