<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentbioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentbios', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('student_code')->unique();
          $table->string('index_number');
          $table->string('adm_no')->unique()->nullable();
          $table->string('cid_no')->unique()->nullable();
          $table->string('Name');
            $table->date('dob');
          $table->string('gender');
          $table->string('blood_group');

          $table->bigInteger('current_class');
          $table->string('current_section');
          $table->string('village');
          $table->string('gewog');
          $table->string('dzongkhag');
          $table->string('mother_name')->nullable();
          $table->string('father_name')->nullable();
          $table->string('guardian_contact');
          $table->string('self_contact')->nullable();
          $table->string('email')->unique();
          $table->date('date_of_joining_school');
          $table->bigInteger('class_when_joining_school');
          $table->longText('previous_schools')->nullable();
          $table->string('hostel_status');
          $table->string('house');
          $table->string('kidu_receipent')->nullable();
          $table->string('differently_abled')->nullable();
          $table->string('img_location')->nullable();
          $table->integer('user_id')->unsigned();
          $table->string('user_name');
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
        Schema::dropIfExists('studentbio');
    }
}
