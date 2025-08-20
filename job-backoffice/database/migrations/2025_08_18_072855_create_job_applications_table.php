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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->decimal('ai_generated_score', 5, 2)->default(0.00);
            $table->mediumText('ai_generated_feedback')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Rejected'])->default('Pending');
            $table->timestamps();
            $table->softDeletes();

            // Relationships
            $table->foreignUuid('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignUuid('job_vacancy_id')
                ->constrained('job_vacancies')
                ->restrictOnDelete();

            $table->foreignUuid('resume_id')
                ->constrained('resumes')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
