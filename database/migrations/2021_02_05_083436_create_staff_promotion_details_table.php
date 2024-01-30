<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffPromotionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_promotion_details', function (Blueprint $table) {
            $table->id();
            $table->string('cid');
            $table->string('position_title')->nullable();
            $table->string('position_level')->nullable();
            $table->string('grade')->nullable();
            $table->date('promotion_date');
            $table->string('promotion_type');
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
        Schema::dropIfExists('staff_promotion_details');
    }
}
