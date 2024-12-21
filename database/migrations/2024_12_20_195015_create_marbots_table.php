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
        Schema::create('marbots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imam_id')->nullable()->constrained('imams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('masjid_id')->nullable()->constrained('masjids')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('bayaran_pokok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marbots');
    }
};
