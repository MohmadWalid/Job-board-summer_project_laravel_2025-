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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->mediumText('description');
            $table->mediumText('required_skills');
            $table->string('location');
            $table->decimal('salary', 10, 2);
            $table->enum('type', ['full-time', 'contract', 'remote', 'hybrid'])->default('full-time');
            $table->timestamps();
            $table->softDeletes();

            // Relationships
            $table->foreignUuid('company_id')
                ->constrained('companies')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
