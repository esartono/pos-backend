<?php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Category::class;
    }

    public function getParents($limit)
    {
        return $this->scopeQuery(function ($query) {
            return $query->with(['childs'])
                ->whereNull('parent_id');
        })
        ->orderBy('name', 'ASC')
        ->paginate($limit);
    }

    public function findParent($id)
    {
        return $this->scopeQuery(function ($query) use ($id) {
            return $query->whereNull('parent_id')
                ->where('id', $id);
        })
        ->first();
    }
}
