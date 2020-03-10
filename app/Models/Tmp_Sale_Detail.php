<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Tmp_Sale;
use App\Models\Product;

class Tmp_Sale_Detail extends Model
{
    protected $table = "tmp_sale_detail";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tmp_sale_id', 'product_id', 'price', 'qty', 'sub_total',
        'created_by', 'updated_by',
    ];


    /**
     *  Sale
     */
    public function tmp_sale()
    {
        return $this->belongsTo(Tmp_Sale::class, 'id');
    }

    /**
     * Product
     */
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }


}
