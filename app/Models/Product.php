<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name'];

    public function productBuyItems()
    {
        return $this->hasMany(ProductBuyItem::class);
    }

    
}
