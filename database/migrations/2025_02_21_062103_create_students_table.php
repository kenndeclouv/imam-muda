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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fullname');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->text('address')->nullable();
            $table->string('school');
            $table->string('father_name');
            $table->string('father_job');
            $table->string('mother_name');
            $table->string('mother_job');
            $table->text('motivation')->nullable();
            $table->enum('class_time', ['morning', 'evening']);
            $table->enum('residence_status', ['mukim', 'non_mukim']);
            $table->string('infaq');
            $table->string('whatsapp');
            $table->string('youtube_link')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
