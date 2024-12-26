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
        Schema::create('personal_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('job_title'); // Nama jabatan pekerjaan
            $table->string('company_name'); // Nama perusahaan
            $table->string('location'); // Lokasi perusahaan
            $table->date('start_date'); // Tanggal mulai
            $table->date('end_date'); // Tanggal selesai
            $table->boolean('is_working')->default(true); // Apakah masih bekerja
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_data');
    }
};
