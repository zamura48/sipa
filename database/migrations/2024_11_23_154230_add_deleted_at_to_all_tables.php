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
            $table->softDeletes();
        });

        Schema::table('iurans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('jenis_iurans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('jadwal_by_siswas', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('jadwal_details', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('jadwals', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('kamars', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('keringanans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pilihans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('periodes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('siswas', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tagihan_keringanans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tagihans', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensis', function (Blueprint $table) {
            if (Schema::hasColumn('absensis', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('iurans', function (Blueprint $table) {
            if (Schema::hasColumn('iurans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('jenis_iurans', function (Blueprint $table) {
            if (Schema::hasColumn('jenis_iurans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('jadwal_by_siswas', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_by_siswas', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('jadwal_details', function (Blueprint $table) {
            if (Schema::hasColumn('jadwal_details', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('jadwals', function (Blueprint $table) {
            if (Schema::hasColumn('jadwals', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('kamars', function (Blueprint $table) {
            if (Schema::hasColumn('kamars', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('keringanans', function (Blueprint $table) {
            if (Schema::hasColumn('keringanans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('pilihans', function (Blueprint $table) {
            if (Schema::hasColumn('pilihans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('periodes', function (Blueprint $table) {
            if (Schema::hasColumn('periodes', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('siswas', function (Blueprint $table) {
            if (Schema::hasColumn('siswas', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('tagihan_keringanans', function (Blueprint $table) {
            if (Schema::hasColumn('tagihan_keringanans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('tagihans', function (Blueprint $table) {
            if (Schema::hasColumn('tagihans', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });

        Schema::table('roles', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropColumn('deleted_at');
            }
        });
    }
};
