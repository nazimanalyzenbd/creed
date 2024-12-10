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
        Schema::create('t_admin_subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('plan_name', 100)->comment('Subscription Plan Name');
            $table->unsignedBigInteger('country_id');
            $table->double('monthly_cost', 8,2)->default(0);
            $table->unsignedBigInteger('discount')->default(0); 
            $table->double('yearly_cost', 8,2)->default(0);
            $table->mediumText('description')->nullable(); 
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Admin user who created the record');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('Admin user who last updated the record');
            $table->foreign('country_id')->references('id')->on('t_admin_countries')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('t_admin_users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('t_admin_users')->onDelete('SET NULL');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');

            // Indexes
            $table->index('plan_name');
            $table->index('country_id');
            $table->index('monthly_cost');
            $table->index('discount');
            $table->index('yearly_cost');
            $table->index('status');
            $table->index('created_by');
            $table->index('updated_by');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin_subscription_plans');
        $table->dropColumn('country_id');
    }
};
