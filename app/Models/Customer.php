<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $guard = "customer";
    protected $table = "customer";
    public $incrementimng = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'email_verified_at', 'password',
        'name', 'gender', 'address', 'phone_number', 'remember_token',
        'created_by', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
