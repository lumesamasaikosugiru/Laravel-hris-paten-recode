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
        Schema::create('applicant_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_biodata_id')->constrained('applicant_biodatas')->cascadeOnDelete();
            $table->string('company');
            $table->string('position');             // fix: hapus 'job_title' duplikat, pakai 'position'
            $table->date('start_date');
            $table->date('end_date')->nullable();   // nullable = masih bekerja di sini
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_experiences');
    }
};
