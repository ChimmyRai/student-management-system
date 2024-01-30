<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffemploymentdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_employment_details', function (Blueprint $table) {
            $table->id();
            $table->string('cid');
            $table->string('school');
            $table->string('dzongkhag_served');
            $table->date('start_date');
            $table->date('end_date')->nullable()->default(NULL);
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
        Schema::dropIfExists('staff_employment_details');
    }
}
