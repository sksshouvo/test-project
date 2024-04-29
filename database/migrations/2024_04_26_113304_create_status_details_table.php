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
        Schema::create('status_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("statusable_id")->nullable();
            $table->string("statusable_type")->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('creator_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_details');
    }
};
