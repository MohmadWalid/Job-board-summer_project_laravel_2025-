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
        Schema::create('job_category', function (Blueprint $table) {

            // Relationships
            $table->foreignUuid('job_id')
                ->constrained('job_vacancies')
                ->restrictOnDelete();

            $table->foreignUuid('category_id')
                ->constrained('categories')
                ->restrictOnDelete();

            // Composite primary key
            $table->primary(['job_id', 'category_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_category');
    }
};
