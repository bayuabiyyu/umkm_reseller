<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Sale_Detail extends Model
{
    protected $table = "sale_detail";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id', 'product_id', 'price', 'qty', 'sub_total',
        'created_by', 'updated_by',
    ];


    /**
     *  Sale
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'id');
    }

}
