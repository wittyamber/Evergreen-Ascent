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
        Schema::table('applications', function (Blueprint $table) {
        // We add a new column for the file path
            $table->string('cover_letter_path')->nullable()->after('resume_path');
            
            // Optional: make the old text column nullable if it isn't already, 
            // or just ignore it moving forward.
            $table->text('cover_letter')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('cover_letter_path');
        });
    }
};
