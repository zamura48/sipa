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
            $table->date('jatuh_tempo')->nullable();
            $table->double('total_tagihan')->nullable();
            $table->double('total_semua_keringanan')->nullable();
            $table->double('total_semua')->nullable();
            $table->double('nominal_bayar')->nullable();
            $table->text('bukti_bayar')->nullable();
            $table->integer('status')->nullable();
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
