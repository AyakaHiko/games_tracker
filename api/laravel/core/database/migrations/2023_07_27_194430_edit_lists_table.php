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
        Schema::table('lists', function (Blueprint $table) {
            $table->dropForeign(['list_type_id']);
            $table->dropColumn('list_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lists', function (Blueprint $table) {
            $table->unsignedBigInteger('list_type_id');
            $table->foreign('list_type_id')->references('id')->on('list_types')->onDelete('cascade');
        });
    }
};
