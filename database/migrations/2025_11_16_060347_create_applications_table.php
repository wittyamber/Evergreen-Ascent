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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The applicant
            $table->foreignId('job_posting_id')->constrained()->onDelete('cascade'); // The job they applied for
            $table->string('resume_path');
            $table->text('cover_letter')->nullable();
            $table->enum('status', [
                'Submitted',
                'Under Review',
                'Interview Scheduled',
                'Offer Extended',
                'Hired',
                'Rejected'
            ])->default('Submitted');
            $table->timestamps();

            // Add a unique constraint to prevent a user from applying to the same job twice
            $table->unique(['user_id', 'job_posting_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
