<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments ('id');
            $table->string('description');
               //clave foreana de doctor
               //doctor
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id') -> references('id') -> on('users');
            //id de paciente
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id') -> references('id') -> on('users');
               //clave foreana de especialidad
               //specialty
            $table->unsignedBigInteger('specialty_id');
            $table->foreign('specialty_id')->references('id')->on('specialties');
           
            $table->date('scheduled_date');
            $table->time('scheduled_time');

            $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
