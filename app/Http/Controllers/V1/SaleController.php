<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Sale\CreateRequest;
use App\Http\Requests\Sale\UpdateRequest;
use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SaleController extends Controller
{
    public function __construct(SaleRepository $sale)
    {
        $this->sale = $sale;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $sales = $this->sale->orderBy('sale_at', 'DESC')->paginate($limit);

            return $this->responseSuccess($sales);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('customer_id', 'sale_at', 'description');
            $items = $request->sale_items;

            \DB::beginTransaction();
            $sale = $this->sale->create($data);

            foreach ($items as $item) {
                $sale->saleItems()->create($item);
            }
            \DB::commit();

            return $this->responseSuccess($sale->load('saleItems'));
        } catch (Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $sale = $this->sale->find($id);

            $data = $request->only('customer_id', 'sale_at', 'description');
            $items = $request->sale_items;

            \DB::beginTransaction();
            $sale = $this->sale->update($data, $id);

            foreach ($items as $item) {
                $sale->saleItems()->updateOrCreate([
                    'id' => $item['id']
                ], $item);
            }
            \DB::commit();

            return $this->responseSuccess($sale->load('saleItems'));
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function view($id)
    {
        try {
            $sale = $this->sale->with('saleItems')->find($id);

            return $this->responseSuccess($sale);
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
            $sale = $this->sale->find($id);

            \DB::beginTransaction();
            $items = $sale->saleItems()->delete();
            $sale = $this->sale->delete($id);

            \DB::commit();
            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
