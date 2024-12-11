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
        Schema::table('t_businesses', function (Blueprint $table) {
            $table->unsignedBigInteger('creed_tags_id')->after('business_tags_id');
            $table->foreign('creed_tags_id')
                ->references('id')->on('t_creed_tags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_businesses', function (Blueprint $table) {
           
            $table->dropForeign(['creed_tags_id']);
            $table->dropColumn('creed_tags_id');
        });
    }
};
