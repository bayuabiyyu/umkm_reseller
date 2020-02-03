<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('customer.home');
});


// ADMIN ROUTES
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {

    // For guest admin before auth
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login_form');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('login', 'Auth\LoginController@login')->name('login_action');


    // For auth admin after auth
    Route::group(['middleware' => ['auth:admin']], function () {
        // Home
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        // Master Category
        Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
            Route::get('/', 'CategoryController@index')->name('index');
            Route::get('/{id}/show', 'CategoryController@show')->name('show');
            Route::get('/create', 'CategoryController@create')->name('create');
            Route::get('/{id}/edit', 'CategoryController@edit')->name('edit');
            Route::post('/', 'CategoryController@store')->name('store');
            Route::post('/datatables', 'CategoryController@dataTable')->name('datatables');
            Route::put('/{id}', 'CategoryController@update')->name('update');
            Route::delete('/{id}', 'CategoryController@destroy')->name('destroy');
        });

        // Master Unit
        Route::group(['prefix' => 'unit', 'as' => 'unit.'], function () {
            Route::get('/', 'UnitController@index')->name('index');
            Route::get('/{id}/show', 'UnitController@show')->name('show');
            Route::get('/create', 'UnitController@create')->name('create');
            Route::get('/{id}/edit', 'UnitController@edit')->name('edit');
            Route::post('/', 'UnitController@store')->name('store');
            Route::post('/datatables', 'UnitController@dataTable')->name('datatables');
            Route::put('/{id}', 'UnitController@update')->name('update');
            Route::delete('/{id}', 'UnitController@destroy')->name('destroy');
        });

        // Master Supplier
        Route::group(['prefix' => 'supplier', 'as' => 'supplier.'], function () {
            Route::get('/', 'SupplierController@index')->name('index');
            Route::get('/{id}/show', 'SupplierController@show')->name('show');
            Route::get('/create', 'SupplierController@create')->name('create');
            Route::get('/{id}/edit', 'SupplierController@edit')->name('edit');
            Route::post('/', 'SupplierController@store')->name('store');
            Route::post('/datatables', 'SupplierController@dataTable')->name('datatables');
            Route::put('/{id}', 'SupplierController@update')->name('update');
            Route::delete('/{id}', 'SupplierController@destroy')->name('destroy');
        });

        // Master Product
        Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
            Route::get('/', 'ProductController@index')->name('index');
            Route::get('/{id}/show', 'ProductController@show')->name('show');
            Route::get('/create', 'ProductController@create')->name('create');
            Route::get('/{id}/edit', 'ProductController@edit')->name('edit');
            Route::post('/', 'ProductController@store')->name('store');
            Route::post('/datatables', 'ProductController@dataTable')->name('datatables');
            Route::put('/{id}', 'ProductController@update')->name('update');
            Route::delete('/{id}', 'ProductController@destroy')->name('destroy');
        });

    });

});
//  END ADMIN ROUTES

// CUSTOMER ROUTES
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => 'Customer'], function () {

    Route::get('/home', 'HomeController@index')->name('home');

});
// END CUSTOMER ROUTES
