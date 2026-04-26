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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('employee_category_id')->constrained();

            $table->foreignId('school_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('position_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('applicant_biodata_id')->nullable()->constrained()->nullOnDelete();
            $table->date('hire_date');

            // NIPY
            $table->string('nipy')->unique()->nullable();
            $table->timestamp('nipy_generated_at')->nullable();

            // probation
            $table->date('probation_end_date');

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['employee_category_id', 'is_active']);
            $table->unique(['user_id', 'applicant_biodata_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
