<?php
namespace App\Repositories;

use App\Models\Supplier;
use App\Repositories\AbstractRepository;

class SupplierRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Supplier::class;
    }
}
