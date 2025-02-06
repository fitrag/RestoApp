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
        Schema::table('menus', function (Blueprint $table) {
            // Tambahkan kolom gambar
            $table->string('gambar')->nullable()->after('kategori_id'); // Kolom gambar bersifat opsional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('menus', function (Blueprint $table) {
            // Hapus kolom gambar jika migrasi dibatalkan
            $table->dropColumn('gambar');
        });
    }};
