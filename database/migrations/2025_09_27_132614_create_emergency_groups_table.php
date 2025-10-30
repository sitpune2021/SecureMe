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
        Schema::create('emergency_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('signal_id');
            $table->string('group_name');
            $table->timestamps();

            $table->foreign('signal_id')->references('id')->on('emergency_signals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_groups');
    }
};
