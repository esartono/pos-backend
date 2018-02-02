<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Supplier\CreateRequest;
use App\Http\Requests\Supplier\UpdateRequest;
use App\Repositories\SupplierRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierController extends Controller
{
    public function __construct(SupplierRepository $supplier)
    {
        $this->supplier = $supplier;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $suppliers = $this->supplier->paginate($limit);

            return $this->responseSuccess($suppliers);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('name', 'description');

            $supplier = $this->supplier->create($data);

            return $this->responseSuccess($supplier);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $supplier = $this->supplier->find($id);

            $data = $request->only('name', 'description');

            $supplier = $this->supplier->update($data, $id);

            return $this->responseSuccess($supplier);
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
            $supplier = $this->supplier->find($id, ['id']);

            $supplier = $this->supplier->delete($id);

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
