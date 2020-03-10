<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sale_Detail;

class Sale extends Model
{
    protected $table = "sale";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_code', 'admin_id', 'customer_id', 'date', 'total', 'tax', 'etc', 'grand_total',
        'pay', 'change', 'note',
        'created_by', 'updated_by',
    ];


    /**
     * Detail
     *
     */
    public function details()
    {
        return $this->hasMany(Sale_Detail::class, 'sale_id');
    }

}
