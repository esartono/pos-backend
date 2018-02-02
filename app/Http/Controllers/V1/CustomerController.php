<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Customer\CreateRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Repositories\CustomerRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends Controller
{
    public function __construct(CustomerRepository $customer)
    {
        $this->customer = $customer;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $customers = $this->customer->paginate($limit);

            return $this->responseSuccess($customers);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('name', 'description');

            $customer = $this->customer->create($data);

            return $this->responseSuccess($customer);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $customer = $this->customer->find($id);

            $data = $request->only('name', 'description');

            $customer = $this->customer->update($data, $id);

            return $this->responseSuccess($customer);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function delete($id)
    {
        try {
            $customer = $this->customer->find($id, ['id']);

            $customer = $this->customer->delete($id);

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
