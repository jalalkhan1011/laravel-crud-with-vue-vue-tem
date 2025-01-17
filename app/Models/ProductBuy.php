<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBuy extends Model
{
    protected $fillable = ['uuid', 'sub_total', 'total'];

    public function productBuyItems()
    {
        return $this->hasMany(ProductBuyItem::class);
    }
}
