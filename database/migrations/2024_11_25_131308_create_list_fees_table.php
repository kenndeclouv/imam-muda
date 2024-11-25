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
        Schema::create('list_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imam_id')->nullable()->constrained('imams')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('masjid_id')->nullable()->constrained('masjids')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('shalat_id')->nullable()->constrained('shalats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('fee_id')->constrained('fees')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_fees');
    }
};
