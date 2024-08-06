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
        Schema::create('parts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedInteger('qty');
            $table->foreignId('source_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('laser')->nullable();
            $table->unsignedInteger('welding')->nullable();
            $table->unsignedInteger('assembling')->nullable();
            $table->unsignedInteger('electro')->nullable();

            $table->unsignedInteger('order_idx');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parts');
    }
};
