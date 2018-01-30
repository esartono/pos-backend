<?php

namespace App\Http\Controllers\V1;

use App\Repositories\UserRepository;
use App\Http\Requests\User\UpdatePasswordRequest;
use Log;
use Tymon\JWTAuth\JWTAuth;

class UpdatePasswordController extends Controller
{
    protected $userRepo;
    protected $curentUser;

    public function __construct(UserRepository $userRepo, JWTAuth $auth) {
        $this->userRepo           = $userRepo;
        try {
            $this->curentUser = $auth->parseToken()->authenticate();
        } catch (JWTException $e) {
            return $this->responseUnauthorized();
        }
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        try {
            $id         = $this->curentUser->id;
            $userData  = [
                'password'         => $request->password,
            ];
            $this->userRepo->update($userData, $id);
            return $this->responseSuccess();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
