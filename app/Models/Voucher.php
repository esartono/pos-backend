<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use SoftDeletes;

    const RECEIPT   = 1; // THU
    const PAYMENT   = 2; // CHI

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'arise_at',
        'recipient_name',
        'reason',
        'amount',
        'description',
    ];

    protected $dates = [
        'arise_at',
        'deleted_at'
    ];
}
