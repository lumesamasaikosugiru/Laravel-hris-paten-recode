<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_applicants', function (Blueprint $table) {
            $table->id();

            $table->foreignId('job_vacancy_id')->constrained()->cascadeOnDelete();
            $table->foreignId('applicant_id')->constrained('applicant_biodata')->cascadeOnDelete();

            $table->string('status')->index();
            // applied, screening, interview, accepted, rejected

            $table->timestamp('applied_at');

            $table->timestamps();

            $table->unique(['job_vacancy_id', 'applicant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applicants');
    }
};
