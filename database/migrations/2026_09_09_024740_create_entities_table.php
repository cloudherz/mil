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
        Schema::create('entities', function (Blueprint $table) {
            $table->id('entity_id')->unique();
            $table->string('organization_name', 256)->nullable();
            $table->string('organization_tin', 256)->nullable();
            $table->string('organization_representative', 256)->nullable();
            $table->string('email', 256)->nullable();
            $table->string('phone', 256)->nullable();
            $table->string('track_1', 256)->nullable();
            $table->string('track_2', 256)->nullable();
            $table->string('track_3', 256)->nullable();
            $table->text('description')->nullable();
            $table->string('submit_date', 256)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entities');
    }
};
