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
        Schema::create('game_list', function (Blueprint $table) {
            $table->id();
            $table->timestamps();$table->unsignedBigInteger('game_id');
            $table->unsignedBigInteger('list_id');

            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
            $table->unique(['game_id', 'list_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_list');
    }
};
