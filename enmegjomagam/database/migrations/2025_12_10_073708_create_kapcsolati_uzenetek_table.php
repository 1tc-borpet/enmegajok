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
        Schema::create('kapcsolati_uzenetek', function (Blueprint $table) {
            $table->id();
            $table->string('nev', 100);
            $table->string('email', 255);
            $table->text('uzenet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kapcsolati_uzenetek');
    }
};
