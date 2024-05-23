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
        Schema::table('detail_pengajuan_purchase', function (Blueprint $table) {
            $table->string('kode')->after('id')->nullable();

            // Hapus foreign key dan kolom id_pengajuan
            $table->dropForeign(['id_pengajuan']);
            $table->dropColumn('id_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_pengajuan_purchase', function (Blueprint $table) {
            // Tambahkan kembali kolom id_pengajuan
            $table->foreignId('id_pengajuan')->constrained('pengajuan_purchase')->onDelete('cascade')->after('id');

            // Hapus kolom kode
            $table->dropColumn('kode');
        });
    }
};
