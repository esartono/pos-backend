<?php

namespace App\Http\Controllers\V1\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\V1\Controller;
use App\Http\Requests\LoginForm;
use App\Models\Role;
use App\Repositories\UserRepository;

class LoginController extends Controller
{
    protected $auth;
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @param JWTAuth $auth
     * @param UserRepository $userRepo
     */
    public function __construct(JWTAuth $auth, UserRepository $userRepo)
    {
        $this->auth = $auth;
        $this->userRepo = $userRepo;
    }

    public function login(LoginForm $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (! $userToken = $this->auth->attempt($credentials)) {
                return $this->responseUnauthorized(__('messages.wrong_email_or_password'));
            }

            $user = $this->auth->setToken($userToken)->authenticate();

            if (! $user) {
                return $this->responseError(__('messages.unauthorized'), 401);
            }

            return $this->responseLoginSuccess($user, [
                'id',
                'email',
                'name'
            ]);
        } catch (Exception $e) {
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function logout()
    {
        try {
            $userToken = $this->auth->getToken();

            if ($userToken) {
                $this->auth->setToken($userToken)->invalidate();
            }

            return $this->responseSuccess();
        } catch (JWTException $e) {
            return $this->responseError(__('messages.token_invalid'), $e->getCode());
        }
    }
}
