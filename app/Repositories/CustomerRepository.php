<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\AbstractRepository;

class CustomerRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Customer::class;
    }
}
