<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::create('detail_penilaians', function (Blueprint $table) {
        $table->id();
        $table->foreignId('penilaian_id')->constrained('penilaians')->onDelete('cascade');
        $table->foreignId('kriteria_id')->constrained('kriterias')->onDelete('cascade');
        $table->integer('skor')->default(0);
        $table->timestamps();
    });
}

    
    public function down(): void
    {
        Schema::dropIfExists('detail_penilaians');
    }
};
