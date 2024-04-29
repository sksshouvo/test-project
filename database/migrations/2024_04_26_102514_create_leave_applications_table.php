<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LeaveType;
use App\Enums\Status;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('leave_applications', function (Blueprint $table) {
            $table->id();
            $table->date("start_date")->nullable();
            $table->date("end_date")->nullable();
            $table->enum("leave_type", LeaveType::array())->nullable();
            $table->enum("status", Status::array())->deafult('pending');
            $table->text("note")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_applications');
    }
};
