<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('position'); // Posisi pekerjaan
            $table->text('description'); // Deskripsi pekerjaan
            $table->text('qualifications'); // Kualifikasi yang dibutuhkan
            $table->decimal('salary', 15, 2); // Gaji
            $table->string('location'); // Lokasi pekerjaan
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // Relasi ke perusahaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
