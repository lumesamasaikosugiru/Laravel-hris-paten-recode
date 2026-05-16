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
        Schema::create('nipy_sequences', function (Blueprint $table) {
            $table->id();
            $table->string('year', 2);            // YY, misal '25'
            $table->string('education_code', 10); // kode dari education_levels
            $table->string('category_code', 5);   // kode dari employee_categories
            $table->unsignedInteger('last_number')->default(0);
            $table->timestamps();

            $table->unique(['year', 'education_code', 'category_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nipy_sequences');
    }
};
