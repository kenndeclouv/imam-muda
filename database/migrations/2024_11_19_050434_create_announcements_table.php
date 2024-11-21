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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('target_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->string('link')->nullable();
            $table->string('title');
            $table->string('photo')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_active')->default(true);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
