<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleAccessAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_code', 10)->unique();
            $table->string('role_name', 10);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('permission', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('route_name', 10)->unique();
            $table->string('permission_name', 10);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('module', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role_id', 10);
            $table->string('permission_id', 10);
            $table->string('module_code')->unique();
            $table->string('module_name', 20);
            $table->timestamps();
            $table->string('created_by', 10);
            $table->string('updated_by', 10);
        });

        Schema::create('role_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_id', 10);
            $table->string('role_id', 10);
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
        // Schema::dropIfExists('role_access_admin');
    }
}
