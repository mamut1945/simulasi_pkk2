<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kamars', function (Blueprint $table) {
            $table->id();
            $table->integer('no_kamar')->unique();
            $table->enum('tipe', ['Standard','Deluxe','Suite'])->default('Standard');
            $table->unsignedBigInteger('harga'); // harga dalam rupiah, integer
            $table->enum('status', ['Tersedia','Tidak tersedia'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
