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
        Schema::create('parent_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->constrained('parts', 'id')->onDelete('cascade');
            $table->foreignId('part_id')->constrained('parts', 'id')->onDelete('restrict');
            $table->unsignedInteger('qty');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_parts');
    }
};