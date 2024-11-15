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
        Schema::create('comparison', function (Blueprint $table) {
            $table->id();
            $table->string('model_number');
            $table->string('secondary_material');
            $table->string('filling_mateerial');
            $table->string('maximum_load_capacity');
            $table->string('width');
            $table->string('height');
            $table->string('domestic_warranty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comparison');
    }
};
