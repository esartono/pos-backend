<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Purchase\CreateRequest;
use App\Http\Requests\Purchase\UpdateRequest;
use App\Repositories\PurchaseRepository;
use App\Repositories\PurchaseItemRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PurchaseController extends Controller
{
    public function __construct(PurchaseRepository $purchase, PurchaseItemRepository $purchaseItem)
    {
        $this->purchase = $purchase;
        $this->purchaseItem = $purchaseItem;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $purchases = $this->purchase->orderBy('purchase_at', 'DESC')->paginate($limit);

            return $this->responseSuccess($purchases);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('supplier_id', 'purchase_at', 'description');
            $items = $request->purchase_items;

            \DB::beginTransaction();
            $purchase = $this->purchase->create($data);

            foreach ($items as $item) {
                $purchase->purchaseItems()->create($item);
            }
            \DB::commit();

            return $this->responseSuccess($purchase->load('purchaseItems'));
        } catch (Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $purchase = $this->purchase->find($id);

            $data = $request->only('supplier_id', 'purchase_at', 'description');
            $items = $request->purchase_items;

            \DB::beginTransaction();
            $purchase = $this->purchase->update($data, $id);

            foreach ($items as $item) {
                $purchase->purchaseItems()->updateOrCreate([
                    'id' => $item['id']
                ], $item);
            }
            \DB::commit();

            return $this->responseSuccess($purchase->load('purchaseItems'));
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
            $purchase = $this->purchase->with('purchaseItems')->find($id);

            return $this->responseSuccess($purchase);
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
            $purchase = $this->purchase->find($id);

            \DB::beginTransaction();
            $items = $purchase->purchaseItems()->delete();
            $purchase = $this->purchase->delete($id);

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
