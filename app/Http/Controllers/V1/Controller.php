<?php

namespace App\Http\Controllers\V1;

use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\ResourceException;
use Dingo\Api\Http\Request;
use Illuminate\Support\MessageBag;

class Controller extends BaseController
{
    protected $paginate;

    public function __construct()
    {
        $this->paginate = config('repository.pagination.limit');
    }
    /**
     * Return a 401 unauthorized error.
     *
     * @param string $message
     *
     * @throws \App\Exceptions\ResourceException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseUnauthorized($message = null)
    {
        if ($message == null) {
            $message = __('messages.unauthorized');
        }

        return $this->responseError($message, 401);
    }

    /**
     * Return a success response.
     *
     * @param object $data
     * @param string $message
     * @param int $statusCode
     *
     * @throws \App\Exceptions\ResourceException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseSuccess($data = null, $message = null, $statusCode = 200)
    {
        return response()->json([
            'status_code' => $statusCode,
            'message' => is_null($message) ? __('messages.success') : $message,
            'data' => $data,
        ]);
    }

    protected function responseLoginSuccess($user, array $userFields = [])
    {
        $customClaims = [];

        if (! $token = \JWTAuth::customClaims($customClaims)->fromUser($user)) {
            return $this->responseError(__('messages.something_went_wrong'), 500);
        }

        $responseData = [
            'access_token' => $token,
            'user' => empty($userFields) ? $user : $user->only($userFields)
        ];

        return $this->responseSuccess($responseData);
    }

    /**
     * Return an error response.
     *
     * @param string $message
     * @param int $statusCode
     *
     * @throws \App\Exceptions\ResourceException
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function responseError($message, $statusCode)
    {
        if ($message instanceof MessageBag) {
            $message = array_values($message->messages())[0][0];
        }
        throw new ResourceException($statusCode, $message, $message);
    }

    protected function getPaginate(Request $request)
    {
        return ($request->has('limit'))
            ? ($request->get('limit') <= $this->paginate ? intval($request->get('limit')) : $this->paginate)
            : $this->paginate;
    }
}
