<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller
{
    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $categories = $this->category->getParents($limit);

            return $this->responseSuccess($categories);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('parent_id', 'name', 'description');

            // Check if parent model exist
            if (null !== $data['parent_id']) {
                $parent = $this->category->findParent($data['parent_id']);

                if (null === $parent) {
                    return $this->responseError(__('messages.parent_model_not_found'), 422);
                }
            }

            $category = $this->category->create($data);

            return $this->responseSuccess($category);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $category = $this->category->find($id);

            $data = $request->only('parent_id', 'name', 'description');

            // Check if parent model exist
            if (null !== $data['parent_id']) {
                $parent = $this->category->findParent($data['parent_id']);

                if (null === $parent) {
                    return $this->responseError(__('messages.parent_model_not_found'), 422);
                }
            }

            $category = $this->category->update($data, $id);

            return $this->responseSuccess($category);
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
            $category = $this->category->withCount(['childs', 'products'])->find($id, ['id', 'parent_id']);

            if ($category->childs_count > 0 || $category->products_count > 0) {
                return $this->responseError(__('messages.can_not_delete_this_model'), 422);
            }

            $category = $this->category->delete($id);

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
