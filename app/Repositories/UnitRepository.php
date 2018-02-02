<?php
namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\AbstractRepository;

class UnitRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Unit::class;
    }
}
