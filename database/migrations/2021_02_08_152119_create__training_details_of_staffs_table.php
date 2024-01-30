<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingDetailsOfStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_training_details', function (Blueprint $table) {
            $table->id();
            $table->string('cid');
            $table->string('training_name');
            $table->date('training_start_date');
            $table->date('training_end_date');
            $table->string('attendence_type')->nullable();
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
        Schema::dropIfExists('staff_training_details');
    }
}
