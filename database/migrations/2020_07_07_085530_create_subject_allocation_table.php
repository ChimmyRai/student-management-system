<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('allocated_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('Admin_ID');
            $table->integer('User_ID');
            $table->string('Name_of_teacher');
            $table->string('Subject');
            $table->integer('Class');
            $table->string('Section');
            $table->integer('Number_of_periods');
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
        Schema::dropIfExists('allocated_subjects');
    }
}
