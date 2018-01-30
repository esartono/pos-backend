<?php
namespace App\Repositories;

use App\Models\Voucher;
use App\Repositories\AbstractRepository;

class VoucherRepository extends AbstractRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return Voucher::class;
    }
}
