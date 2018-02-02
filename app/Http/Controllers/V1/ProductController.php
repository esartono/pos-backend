<?php

namespace App\Http\Controllers\V1;

use Dingo\Api\Http\Request;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductController extends Controller
{
    public function __construct(
        ProductRepository $product,
        CategoryRepository $category
    )
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function index(Request $request)
    {
        try {
            $limit = $this->getPaginate($request);
            $products = $this->product->orderBy('name', 'ASC')->paginate($limit);

            return $this->responseSuccess($products);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function create(CreateRequest $request)
    {
        try {
            $data = $request->only('category_id', 'name', 'retail_price', 'wholesale_price', 'featured_image', 'description');

            // Check if category model exist
            $category = $this->category->find($data['category_id'], ['id']);

            if (null === $category) {
                return $this->responseError(__('messages.category_not_found'), 422);
            }

            // Upload featured image
            if ($request->hasFile('featured_image')) {
                $featuredImage = $request->file('featured_image');
                $fileName = $featuredImage->getClientOriginalName() . '_' . uniqid() . '.' . $featuredImage->getClientOriginalExtension();

                Storage::disk('public')->put('products/'. $fileName, fopen($featuredImage, 'r+'), 'public');

                $data['featured_image'] = 'products/'. $fileName;
            }

            $product = $this->product->create($data);

            return $this->responseSuccess($product);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $product = $this->product->find($id);

            $data = $request->only('category_id', 'name', 'retail_price', 'wholesale_price', 'featured_image', 'description');

            // Check if category model exist
            $category = $this->category->find($data['category_id'], ['id']);

            if (null === $category) {
                return $this->responseError(__('messages.category_not_found'), 422);
            }

            // Upload featured image
            if ($request->hasFile('featured_image')) {
                $disk = Storage::disk('public');

                // Delete old file
                if ($disk->exists($product->featured_image)) {
                    $disk->delete($product->featured_image);
                }

                $featuredImage = $request->file('featured_image');
                $fileName = $featuredImage->getClientOriginalName() . '_' . uniqid() . '.' . $featuredImage->getClientOriginalExtension();

                $disk->put('products/'. $fileName, fopen($featuredImage, 'r+'), 'public');

                $data['featured_image'] = 'products/'. $fileName;
            }

            $product = $this->product->update($data, $id);

            return $this->responseSuccess($product);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }

    public function view($id)
    {
        try {
            $product = $this->product->find($id);

            return $this->responseSuccess($product);
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
            $product = $this->product->find($id, ['id', 'featured_image']);
            $featuredImageUrl = $product->featured_image;

            $product = $this->product->delete($id);

            // Delete featured image
            $disk = Storage::disk('public');
            if ($disk->exists($featuredImageUrl)) {
                $disk->delete($featuredImageUrl);
            }

            return $this->responseSuccess([]);
        } catch (ModelNotFoundException $e) {
            return $this->responseError(__('messages.model_not_found'), 404);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return $this->responseError(__('messages.something_went_wrong'), $e->getCode());
        }
    }
}
