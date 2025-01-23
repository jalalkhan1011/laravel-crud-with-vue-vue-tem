<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBuyItem extends Model
{
    protected $fillable = ['uuid', 'product_buy_id', 'product_id', 'product_purchase_id', 'quantity', 'price', 'total'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function productPurchase()
    {
        return $this->belongsTo(ProductPurchase::class, 'product_purchase_id');
    }

    public function productBuy()
    {
        return $this->belongsTo(ProductBuy::class, 'product_buy_id');
    }
}
