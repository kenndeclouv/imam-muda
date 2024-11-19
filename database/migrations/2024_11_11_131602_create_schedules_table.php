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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imam_id')->constrained('imams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('masjid_id')->constrained('masjids')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('shalat_id')->constrained('shalats')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('date');
            $table->timestamp('end')->nullable();
            $table->enum('status', ['to_do', 'done'])->default('to_do');
            $table->boolean('is_badal')->default(false);
            $table->foreignId('badal_id')->nullable()->constrained('imams')->onDelete('cascade')->onUpdate('cascade');
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
