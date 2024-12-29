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
        Schema::create('t_business_ratings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('business_id');
            $table->unsignedTinyInteger('rating_star');
            $table->mediumText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('holding_time')->nullable();
            $table->boolean('status')->default(0)->comment('1=Published, 0=Unpublished, 2=Hold');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');
            $table->softDeletes();
            // Foreign_key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('t_businesses')->onDelete('cascade');

            // Indexes
            $table->index('user_id');
            $table->index('business_id');
            $table->index('rating_star');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_business_ratings');
        $table->dropForeign(['user_id']);
        $table->dropForeign(['business_id']);
        $table->dropSoftDeletes();
    }
};
