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
        Schema::table('absensis', function (Blueprint $table) {
            $table->tinyInteger('absen')->nullable()->after('siswa_id')->nullable();
            $table->tinyInteger('izin')->nullable()->after('absen')->nullable();
            $table->tinyInteger('masuk')->nullable()->after('izin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
