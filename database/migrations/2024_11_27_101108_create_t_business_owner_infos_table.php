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
        Schema::create('t_business_owner_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('email');
            $table->string('phone_number', 15)->nullable();
            $table->mediumText('address'); 
            $table->unsignedInteger('status')->default(1)->comment('1=business_owner_info_complete, 2=business_info_step1_complete, 3=business_info_step2_complete, 4=business_info_step3_complete, 5=business_info_step4_complete, 6=check_out_complete, 7=payment_success 8=payment_failed');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');
            
            // Foreign_key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes
            $table->index('first_name');
            $table->index('last_name');
            $table->index('email');
            $table->index('phone_number');
            $table->index('user_id');
            // $table->index('business_id');
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
        Schema::dropIfExists('t_business_owner_infos');
    }
};
