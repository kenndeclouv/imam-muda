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
        Schema::create('student_permits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('imam_id')->constrained('imams')->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->enum('type', ['izin', 'sakit']);
            $table->text('reason');
            $table->enum('status', ['approved', 'pending', 'rejected']);
            $table->string('approved_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_permits');
    }
};
