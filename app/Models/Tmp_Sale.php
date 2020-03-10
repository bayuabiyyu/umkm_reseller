<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Tmp_Sale_Detail;
use App\Models\Customer;

class Tmp_Sale extends Model
{
    protected $table = "tmp_sale";
    public $incrementimng = true;

    // Keterangan
    // Tidak ada sale code karena ini bersifat temporary berdasarkan admin

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'admin_id', 'customer_id', 'total', 'tax', 'etc', 'grand_total',
        'pay', 'change', 'note',
        'created_by', 'updated_by',
    ];


    /**
     * Detail
     *
     */
    public function tmp_details()
    {
        return $this->hasMany(Tmp_Sale_Detail::class, 'tmp_sale_id');
    }


    /**
     * customer
     */
    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

}
