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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // User who created the job post
            $table->string('company_name');
            $table->string('job_title');
            $table->text('job_description');
            $table->string('designation');
            $table->decimal('salary_min', 10, 2); // Minimum salary
            $table->decimal('salary_max', 10, 2); // Maximum salary
            $table->string('location');
            $table->string('min_education');
            $table->string('experience');
            $table->string('contact_person_name');
            $table->string('contact_no');
            $table->string('contact_email');
            $table->string('website');
            $table->integer('job_type')->comment('1: Full Time, 2: Part Time');
            $table->integer('shift')->comment('1: Day Shift, 2: Night Shift, 3: Rotational Shift');
            $table->tinyInteger('status')->default(1); // You can change the default status as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
