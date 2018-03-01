<?php
namespace App\Repositories;

use App\Models\PurchaseItem;
use App\Repositories\AbstractRepository;

class PurchaseItemRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return PurchaseItem::class;
    }
}
