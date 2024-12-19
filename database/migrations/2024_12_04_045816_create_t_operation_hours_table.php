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
        Schema::create('t_operation_hours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('business_id')->nullable();
            $table->string('day', 60)->nullable();
            $table->time('open_time')->nullable();
            $table->time('closed_time')->nullable();
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->foreign('business_id')->references('id')->on('t_businesses')->onDelete('SET NULL');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');

            // Indexes
            $table->index('business_id');
            $table->index('day');
            $table->index('open_time');
            $table->index('closed_time');
            $table->index('status');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_opertion_hours');
        $table->dropForeign(['business_id']);
    }
};
