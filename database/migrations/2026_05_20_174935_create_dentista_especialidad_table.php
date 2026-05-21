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
        Schema::create('dentista_especialidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_dentista')->constrained('dentistas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_especialidad')->constrained('especialidades')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dentista_especialidad');
    }
};
