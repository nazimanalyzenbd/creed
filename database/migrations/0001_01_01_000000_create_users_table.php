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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100)->nullable()->comment('name means fullname');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('email')->unique();
            $table->string('country_code', 7)->nullable();
            $table->string('phone_number', 15)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable()->comment('Stores the user\'s hashed password with minimum 8length');
            $table->rememberToken();
            $table->string('google_id')->nullable(); 
            $table->mediumText('avatar')->nullable(); 
            $table->mediumText('address')->nullable(); 
            $table->string('country', 100)->nullable(); 
            $table->string('state', 100)->nullable(); 
            $table->string('city', 100)->nullable(); 
            $table->unsignedBigInteger('zip_code')->nullable(); 
            $table->string('account_type', 10)->default('G')->comment('G=General Account, GB=General+Business Account');
            $table->string('otp')->nullable(); 
            $table->timestamp('otp_expires_at')->nullable(); 
            $table->boolean('otp_status')->default(0)->comment('1=Used, 0=Unused');
            $table->boolean('status')->default(0)->comment('1=Active, 0=Inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');
            
            // Indexes
            $table->index('name');
            $table->index('email');
            $table->index('phone_number');
            $table->index('account_type');
            $table->index('status');
            $table->index('created_at');
            $table->index('updated_at');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
