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
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->integer('id_produk');
            $table->integer('id_inventory');
            $table->string('satuan');
            $table->string('qty');
            $table->string('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseps');
    }
};
