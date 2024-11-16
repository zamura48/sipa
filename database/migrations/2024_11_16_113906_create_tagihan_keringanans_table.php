<?php

use App\Models\Keringanan;
use App\Models\Tagihan;
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
        Schema::create('tagihan_keringanans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tagihan::class);
            $table->foreignIdFor(Keringanan::class);
            $table->double('total_keringanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan_keringanans');
    }
};
