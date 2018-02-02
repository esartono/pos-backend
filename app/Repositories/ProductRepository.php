<?php
namespace App\Repositories;

use App\Models\Product;
use App\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Product::class;
    }

    public function create(array $attributes)
    {
        $model = parent::create($attributes);

        if (null !== $attributes['unit_id']) {
            $model->units()->attach($attributes['unit_id'], [
                'is_retail_unit' => true,
                'exchange_value' => 1
            ]);
        }

        return $model;
    }

    public function update(array $attributes, $id)
    {
        $model = parent::update($attributes, $id);

        if (null !== $attributes['unit_id']) {
            $model->units()->sync([$attributes['unit_id'] => [
                'is_retail_unit' => true,
                'exchange_value' => 1
            ]]);
        }

        return $model;
    }
}
