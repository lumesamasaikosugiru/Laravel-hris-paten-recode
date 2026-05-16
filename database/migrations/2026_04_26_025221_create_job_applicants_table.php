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
            $table->foreignId('applicant_biodata_id')->constrained('applicant_biodatas')->cascadeOnDelete();
            $table->enum('status', ['applied', 'screening', 'interview', 'accepted', 'rejected'])
                ->default('applied')
                ->index();
            $table->text('notes')->nullable();       // tambah: catatan HR per tahap
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();

            $table->unique(['job_vacancy_id', 'applicant_biodata_id']);
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
