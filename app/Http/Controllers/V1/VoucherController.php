<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Voucher\CreateRequest;
use App\Http\Requests\Voucher\UpdateRequest;
use App\Repositories\VoucherRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VoucherController extends Controller
{
    public function __construct(VoucherRepository $voucher)
    {
        $this->voucher = $voucher;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $vouchers = $this->voucher->orderBy('arise_at', 'DESC')->paginate($limit);

            return $this->responseSuccess($vouchers);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('type', 'arise_at', 'recipient_name', 'reason', 'amount', 'description');

            $voucher = $this->voucher->create($data);

            return $this->responseSuccess($voucher);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $voucher = $this->voucher->find($id);

            $data = $request->only('type', 'arise_at', 'recipient_name', 'reason', 'amount', 'description');

            $voucher = $this->voucher->update($data, $id);

            return $this->responseSuccess($voucher);
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
            $voucher = $this->voucher->find($id);

            $voucher = $this->voucher->delete($id);

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
