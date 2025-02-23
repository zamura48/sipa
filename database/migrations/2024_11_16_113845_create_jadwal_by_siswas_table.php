<?php

use App\Models\Jadwal;
use App\Models\JadwalDetail;
use App\Models\Siswa;
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
        Schema::create('jadwal_by_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Jadwal::class);
            $table->foreignIdFor(Siswa::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_by_siswas');
    }
};
