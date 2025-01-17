<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBuyItem extends Model
{
    protected $fillable = ['uuid','product_buy_id', 'product_id','batech_id','quantity', 'price', 'total'];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function productBuy()
    {
        return $this->belongsTo(ProductBuy::class,'product_buy_id');
    }
}
