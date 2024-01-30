<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassteacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classteachers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id_of_teacher')->unsigned()->unique();
            $table->string('Name_of_teacher');
            $table->integer('Class');
            $table->string('Section');
            $table->integer('user_id_of_updater')->unsigned();
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
        Schema::dropIfExists('classteachers');
    }
}
