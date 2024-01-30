<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrentEmploymentDetailsOfStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_current_employment_details', function (Blueprint $table) {
            $table->id();
            $table->string('cid')->unique();
            $table->string('employment_type');
            $table->string('eid')->unique()->nullable();
            $table->string('agency');
            $table->string('occupational_group');
            $table->string('occupational_subgroup');
            $table->string('job_code');
            $table->date('service_join_date');
            $table->date('current_school_join_date');
            $table->string('tpn');
            $table->string('gis_no');
            $table->string('nppf_no');
            $table->string('bobacc_no');
            $table->date('contract_renewal_last_date')->nullable()->default(NULL);
            $table->date('contract_expiry_date')->nullable()->default(NULL);
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
        Schema::dropIfExists('staff_current_employment_details');
    }
}
