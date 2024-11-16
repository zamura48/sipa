<?php

use App\Models\Iuran;
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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Siswa::class);
            $table->foreignIdFor(Iuran::class);
            $table->date('jatuh_tempo');
            $table->double('total_tagihan');
            $table->double('total_semua_keringanan');
            $table->double('total_semua');
            $table->double('nominal_bayar');
            $table->text('bukti_bayar');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
