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
        Schema::create('t_quotes', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable()->index();
            $table->string('name')->nullable()->index();
            $table->string('email')->nullable()->index();
            $table->string('country_code')->nullable()->index();
            $table->string('phone_number')->nullable()->index();
            $table->mediumText('address')->nullable();
            $table->decimal('lat', 10, 7)->nullable()->comment('address latitude'); 
            $table->decimal('long', 10, 7)->nullable()->comment('address longitude'); 
            $table->boolean('status')->default(1)->comment('1=Active, 0=Inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_quotes');
        $table->dropSoftDeletes();
    }
};
