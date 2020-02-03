<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Initial class
     *
     * @return void
     */
    public function __construct()
    {
       //
    }


    public function index()
    {
        return view('customer.home');
    }
}
