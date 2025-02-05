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
        Schema::create('clothingproducts', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('img')->nullable();
            $table->json('description');
            $table->string('price');
            $table->json('type', 50);
            $table->foreignId('section_id')->constrained('clothingsections')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clothingproduct');
    }
};
