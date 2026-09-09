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
        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id')->unique();
            $table->string('person_name', 256)->nullable();
            $table->string('email', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('track_student', 256)->nullable();
            $table->text('description')->nullable();
            $table->string('submit_date', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
