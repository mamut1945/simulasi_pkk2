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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade');
            $table->string('nama_tamu');
            $table->string('no_hp');
            $table->date('check_in');
            $table->date('check_out');
            $table->integer('jumlah_tamu');
            $table->decimal('total_bayar', 10, 2);
            $table->enum('status_reservasi', ['Booking', 'Check-in', 'Selesai', 'Batal'])
                ->default('Booking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
