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
        Schema::create('t_company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('system_name', 100); 
            $table->string('owner_name', 100);
            $table->string('email')->unique();
            $table->string('phone_number', 15);
            $table->string('business_identification_no', 100)->nullable(); 
            $table->mediumText('address'); 
            $table->string('country', 100)->nullable(); 
            $table->string('state', 100)->nullable(); 
            $table->string('city', 100)->nullable(); 
            $table->unsignedBigInteger('zip_code', 20)->nullable(); 
            $table->string('lat')->nullable()->comment('address latitude'); 
            $table->string('long')->nullable()->comment('address longitude');
            $table->string('logo')->nullable(); 
            $table->string('favicon_icon')->nullable(); 
            $table->string('website_link')->nullable(); 
            $table->string('facebook_id')->nullable(); 
            $table->string('linkedIn_id')->nullable(); 
            $table->string('youtube_link')->nullable(); 
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->unsignedBigInteger('created_by')->nullable()->comment('Admin user who created the record');
            $table->unsignedBigInteger('updated_by')->nullable()->comment('Admin user who last updated the record');
            $table->foreign('created_by')->references('id')->on('t_admin_users')->onDelete('SET NULL');
            $table->foreign('updated_by')->references('id')->on('t_admin_users')->onDelete('SET NULL');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_company_infos');
    }
};
