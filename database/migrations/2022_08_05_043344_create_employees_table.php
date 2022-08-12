<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            //$table->unsignedBigInteger('id_project');
            //$table->unsignedBigInteger('id_salary');
            $table->string('id_company')->unique();
            //$table->string('name');
            $table->string('position')->nullable();
            $table->string('nik')->nullable();
            $table->string('npwp')->nullable();
            $table->date('started')->nullable();
            $table->date('finished')->nullable();
            $table->timestamps();
            $table->softDeletes();
 
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');


            // $table->foreign('id_project')->references('id')->on('projects')->onDelete('cascade');
            // $table->foreign('id_salary')->references('id')->on('psalaries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
