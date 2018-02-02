<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Unit\CreateRequest;
use App\Http\Requests\Unit\UpdateRequest;
use App\Repositories\UnitRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UnitController extends Controller
{
    public function __construct(UnitRepository $unit)
    {
        $this->unit = $unit;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $units = $this->unit->paginate($limit);

            return $this->responseSuccess($units);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('name', 'description');

            $unit = $this->unit->create($data);

            return $this->responseSuccess($unit);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $unit = $this->unit->find($id);

            $data = $request->only('name', 'description');

            $unit = $this->unit->update($data, $id);

            return $this->responseSuccess($unit);
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
            $unit = $this->unit->find($id, ['id']);

            $unit = $this->unit->delete($id);

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
