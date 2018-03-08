<?php
namespace App\Repositories;

use App\Models\Sale;
use App\Repositories\AbstractRepository;

class SaleRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Sale::class;
    }
}
