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
        Schema::create('galeriakepek', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leny_id')->constrained('lenyek')->onDelete('cascade');
            $table->string('kep_url', 500);
            $table->string('leiras', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeriakepek');
    }
};
