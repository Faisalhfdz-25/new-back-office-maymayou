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
        Schema::create('history_produksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_inventory');
            $table->string('satuan');
            $table->integer('qty');
            $table->decimal('harga', 15, 2);
            $table->date('tanggal_pengadaan');
            $table->timestamps();

            $table->foreign('id_inventory')->references('id')->on('inventories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_produksi');
    }
};
