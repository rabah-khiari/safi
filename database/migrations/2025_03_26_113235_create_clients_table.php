<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->id('client_id');
            $table->enum('type', ['person', 'enterprise']);
            $table->string('name');
            $table->string('address');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('clients');
    }
};
