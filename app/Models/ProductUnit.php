<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    protected $table = 'products_units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'unit_id',
        'is_retail_unit',
        'exchange_value',
    ];

    protected $dates = [
    ];

    protected $hidden = [
    ];
}
