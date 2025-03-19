<?php

use App\Models\Keringanan;
use App\Models\Pendaftaran;
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
        Schema::create('pendaftaran_keringanan', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pendaftaran::class)->nullable();
            $table->foreignIdFor(Keringanan::class)->nullable();
            $table->text('dokumen_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_keringanan');
    }
};
