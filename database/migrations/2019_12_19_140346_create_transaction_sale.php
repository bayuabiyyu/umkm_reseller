<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('sale', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_id', 10);
            $table->string('customer_id', 10);
            $table->dateTime('date');
            $table->double('total');
            $table->double('total_ammount');
            $table->double('tax');
            $table->double('tax_nominal');
            $table->double('etc');
            $table->double('grand_total');
            $table->double('pay');
            $table->double('change');
            $table->string('description', 20)->nullable();
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('sale_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sale_id');
            $table->string('product_id', 10);
            $table->double('price');
            $table->integer('qty');
            $table->double('sub_total');
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('stock_out', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id', 10);
            $table->integer('qty');
            $table->string('description', 20);
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
        // Schema::dropIfExists('transaction_sale');
    }
}
