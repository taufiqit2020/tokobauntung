<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'category_id', 'product_code', 'name', 'unit',
    'buy_price', 'sell_price', 'wholesale_price', 'wholesale_min_qty',
    'stock', 'min_stock', 'image_path', 'is_active'
])]
class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockLogs()
    {
        return $this->hasMany(StockLog::class);
    }
}
