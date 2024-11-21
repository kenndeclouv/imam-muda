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
        Schema::create('ayahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surah_id')->constrained('surahs')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('number');
            $table->longText('arab');
            $table->longText('ind');
            $table->integer('number_in_surah');
            $table->integer('juz');
            $table->integer('manzil');
            $table->integer('page');
            $table->integer('ruku');
            $table->integer('hizb_quarter');
            $table->boolean('sajda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayahs');
    }
};
