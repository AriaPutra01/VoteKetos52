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
        Schema::create('student', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->integer('nisn')->length(100)->unique();
            $table->timestamp('nisn_verified_at')->nullable();
            $table->string('kelas', 2);
            $table->enum('jurusan', ['PPLG', 'TJKT', 'MPLB', 'TKRO', 'TSM', 'DKV', 'HOTEL', 'MESIN']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};
