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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->foreignId('interviewer_id')->constrained('users')->onDelete('cascade'); // The HR User conducting the interview
            $table->string('title'); // e.g., "Technical Screening"
            $table->dateTime('scheduled_at');
            $table->unsignedInteger('duration_minutes')->default(30);
            $table->string('location'); // Can be a meeting room or a video call URL
            $table->enum('status', ['Pending Confirmation', 'Scheduled', 'Completed', 'Cancelled'])->default('Pending Confirmation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
