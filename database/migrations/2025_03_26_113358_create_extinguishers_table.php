<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('extinguishers', function (Blueprint $table) {
            $table->id('extinguisher_id');
            $table->string('type'); // CO2, Poudre, Eau
            $table->decimal('size', 5, 2); // e.g., 1L, 2.5L, etc.
            $table->integer('stock')->default(0); // Available units in store
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('extinguishers');
    }
};