<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_id',
        'purchase_at',
        'description',
    ];

    protected $dates = [
        'purchase_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
