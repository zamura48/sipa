<?php

use App\Models\Kamar;
use App\Models\Periode;
use App\Models\WaliMurid;
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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(WaliMurid::class);
            $table->foreignIdFor(Kamar::class);
            $table->foreignIdFor(Periode::class);
            $table->bigInteger('nis')->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('jenis_kelamin', 5)->nullable();
            $table->text('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
