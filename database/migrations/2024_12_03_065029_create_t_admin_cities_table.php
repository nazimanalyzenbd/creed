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
        Schema::create('t_admin_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); 
            $table->unsignedBigInteger('state_id')->nullable();
            $table->string('state_code')->nullable();
            $table->string('country_id')->nullable();
            $table->string('country_code')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->foreign('state_id')->references('id')->on('t_admin_states')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin_cities');
        $table->dropForeign(['state_id']);
    }
};
