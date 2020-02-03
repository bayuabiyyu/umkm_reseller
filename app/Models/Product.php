<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unit_id', 'category_id', 'product_code', 'product_name', 'stock', 'stock_min', 'price_purchase',
        'price_sale', 'price_reseller', 'image', 'created_by', 'updated_by',
    ];
}
