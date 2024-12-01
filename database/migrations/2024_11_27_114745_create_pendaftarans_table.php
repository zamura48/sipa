<?php

use App\Models\Periode;
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
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Periode::class);
            $table->string('nama_ortu', 100)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon_ortu')->nullable();
            $table->string('jenis_kelamin_ortu', 5)->nullable();
            $table->integer('agama')->nullable();
            $table->bigInteger('nis')->nullable();
            $table->string('nama_siswa', 100)->nullable();
            $table->string('jenis_kelamin_siswa', 5)->nullable();
            $table->text('foto_siswa')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
