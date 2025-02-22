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
        Schema::create('t_admin_states', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->unsignedBigInteger('country_id')->nullable();
            $table->string('country_name')->nullable();
            $table->string('latitude', 191)->nullable();
            $table->string('longitude', 191)->nullable();
            $table->foreign('country_id')->references('id')->on('t_admin_countries')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin_states');
        $table->dropForeign(['country_id']);
    }
};
