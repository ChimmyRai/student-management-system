<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultHigherSciTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resulthigherscis', function (Blueprint $table) {
            $table->id();
            $table->string('student_code')->unique();
            $table->string('index_number');
            $table->string('email')->unique()->nullable();
            $table->decimal('dzongkha',8, 2);
            $table->decimal('english',8, 2);
            $table->decimal('math',8, 2);
            $table->decimal('physics',8, 2);
            $table->decimal('chemistry',8, 2);
            $table->decimal('biology',8, 2);
            $table->decimal('average',8, 2);
            $table->string('remarks');
            $table->integer('rank')->unsigned()->nullable();
            $table->string('dues')->nullable();
            $table->integer('class');
            $table->string('section');
            $table->string('exam_type');

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
        Schema::dropIfExists('resulthigherscis');
    }
}
