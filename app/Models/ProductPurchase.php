<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPurchase extends Model
{
    protected $fillable = ['product_id', 'uuid', 'purchase_price', 'price', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function produtBuyItems()
    {
        return $this->hasMany(ProductBuyItem::class);
    }
}
