<?php
namespace App\Repositories;

use App\Models\Purchase;
use App\Repositories\AbstractRepository;

class PurchaseRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Purchase::class;
    }
}
