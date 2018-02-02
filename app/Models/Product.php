<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'unit_id',
        'retail_price',
        'wholesale_price',
        'featured_image',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class, 'products_units');
    }
}
