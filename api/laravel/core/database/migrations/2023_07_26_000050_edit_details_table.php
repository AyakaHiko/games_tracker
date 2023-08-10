<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('game_details', function (Blueprint $table) {
            $table->text('description')->change();
            $table->string('website')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('game_details', function (Blueprint $table) {
            $table->string('description')->change();
            $table->string('website')->change();

        });
    }
};
