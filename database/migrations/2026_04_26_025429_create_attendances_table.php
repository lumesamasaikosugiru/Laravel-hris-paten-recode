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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->foreignId('school_id')->constrained()->cascadeOnDelete();

            $table->date('date')->index();

            // CHECK-IN / OUT
            $table->timestamp('check_in_at')->nullable();
            $table->timestamp('check_out_at')->nullable();

            // AUTO CALCULATED
            $table->integer('late_minutes')->default(0);
            $table->integer('work_minutes')->default(0);

            // STATUS
            $table->string('status')->index();
            // present, absent, leave, holiday

            $table->timestamps();

            // 🔴 ANTI DUPLICATE
            $table->unique(['employee_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
