<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\V1\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    public function reset(ResetPasswordRequest $request)
    {
        try {
            $response = $this->broker()->reset(
                $this->credentials($request), function ($user, $password) {
                    $this->resetPassword($user, $password);
                }
            );

            if ($response === Password::PASSWORD_RESET) {

                return $this->responseSuccess();
            }
            return $this->responseError(__('messages.something_went_wrong'), 500);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }
}
