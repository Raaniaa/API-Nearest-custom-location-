<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 300);
            $table->string('phone', 300);
            $table->string('latitude');
            $table->string('longitude');
            $table->string('specialtyName');
            $table->string('photo')->nullable();
      
            $table->json('work_times')->nullable();
            $table->foreign('specialtyName')->references('specialtyName')->on('specialties')->onDelete('cascade');
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
        Schema::dropIfExists('doctors');
    }
}
