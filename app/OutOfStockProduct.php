<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutOfStockProduct extends Model
{
    protected $table = 'out_of_stock_products';

    protected $fillable = [
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
