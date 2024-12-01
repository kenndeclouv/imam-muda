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
        Schema::create('imams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fullname');
            $table->string('phone')->nullable();
            $table->string('birthplace');
            $table->string('no_rekening')->nullable();
            $table->date('birthdate');
            $table->date('join_date');
            $table->integer('juz')->nullable();
            $table->string('school')->nullable();
            $table->text('address')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['nikah', 'belum nikah'])->default('belum nikah');
            $table->integer('child_count')->nullable();
            $table->integer('wife_count')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imams');
    }
};
