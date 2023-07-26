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
        Schema::create('game_details', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique()->primary();
            $table->foreign('id')->references('id')->on('games')->onDelete('cascade');
            $table->string('slug');
            $table->string('name_original');
            $table->string('description');
            $table->string('background_image_additional');
            $table->string('website');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_details');
    }
};
