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
        Schema::create('mesins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')->constrained('kategori_mesins')->onDelete('cascade');
             $table->string('kode', 100);
              $table->string('merek', 100);
                $table->integer('kapasitas');
                 $table->enum('status', ['Ready', 'Sedang Digunakan', 'Maintenance'])->default('Ready');
                   $table->timestamps();
                   });
                   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mesins');
    }
};
