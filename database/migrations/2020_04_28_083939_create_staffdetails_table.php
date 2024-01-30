<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffdetails', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('cid')->unique();
            $table->string('Name');
            $table->date('dob');
            $table->string('gender');
            $table->string('religion');
            $table->string('nationality');
            $table->string('village');
            $table->string('gewog');
            $table->string('dzongkhag');
            $table->string('house_no')->nullable();
            $table->string('tharm_no')->nullable();
            $table->string('phone');
            $table->string('email')->unique()->nullable();
            $table->string('img_location')->nullable();
            $table->integer('user_id_of_updater')->unsigned();
            $table->string('user_name_of_updater');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffdetails');
    }
}
