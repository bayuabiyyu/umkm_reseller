<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = "supplier";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'supplier_code', 'supplier_name', 'phone_number', 'address', 'city', 'owner', 'created_by', 'updated_by',
    ];
}
