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
        Schema::create('applicant_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_biodata_id')->constrained('applicant_biodatas')->cascadeOnDelete();
            $table->foreignId('education_level_id')->constrained();
            $table->string('institution');
            $table->string('major')->nullable();
            $table->year('graduation_year')->nullable();
            $table->boolean('is_latest')->default(false); // tambah: tandai pendidikan terakhir
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_education');
    }
};
