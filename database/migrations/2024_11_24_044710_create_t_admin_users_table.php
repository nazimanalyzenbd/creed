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
        Schema::create('t_admin_users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index(); 
            $table->string('email', 191)->unique();
            $table->string('phone_number', 15)->unique();
            $table->string('password', 255)->comment('Stores the user\'s hashed password with minimum 8length');
            $table->mediumText('address'); 
            $table->string('country', 100); 
            $table->string('state', 100)->nullable(); 
            $table->string('city', 100);
            $table->string('zip_code', 20);
            $table->boolean('status')->default(0)->comment('1=Active, 0=Inactive');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Stores the creation time of the record');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('Stores the last update time of the record');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_admin_users');
    }
};
