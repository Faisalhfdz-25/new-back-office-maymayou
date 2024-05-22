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
        Schema::create('detail_pengajuan_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengajuan')->constrained('pengajuan_purchase')->onDelete('cascade');
            $table->foreignId('id_inventory')->constrained('inventories')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('harga');
            $table->string('tempat');
            $table->boolean('acc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuan_purchase');
    }
};
