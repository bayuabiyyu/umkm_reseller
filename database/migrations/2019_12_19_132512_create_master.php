<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 10)->unique();
            $table->string('email', 20)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 20);
            $table->string('name', 50);
            $table->string('gender', 10);
            $table->text('address', 100);
            $table->string('phone_number', 20);
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 10)->unique();
            $table->string('email', 20)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 20);
            $table->string('name', 50);
            $table->string('gender', 10);
            $table->text('address', 100);
            $table->string('phone_number', 20);
            $table->boolean('is_reseller');
            $table->rememberToken();
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit_id');
            $table->string('category_id');
            $table->string('product_code', 20)->unique();
            $table->string('product_name', 50);
            $table->integer('stock');
            $table->integer('stock_min');
            $table->double('price_purchase');
            $table->double('price_sale');
            $table->double('price_reseller');
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit_code', 10)->unique();
            $table->string('unit_name', 20);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_code', 10)->unique();
            $table->string('category_name', 20);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('supplier', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_code', 20)->unique();
            $table->string('supplier_name', 50);
            $table->string('phone_number', 20);
            $table->text('address');
            $table->string('city', 20);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('master');
    }
}
