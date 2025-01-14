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
        Schema::create('t_save_businesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('business_id')->index();
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->timestamps();
            $table->softDeletes();
            // Foreign_key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('t_businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_save_businesses');
        $table->dropForeign(['user_id']);
        $table->dropForeign(['business_id']);
        $table->dropSoftDeletes();
    }
};
