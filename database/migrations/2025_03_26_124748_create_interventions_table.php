<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('interventions', function (Blueprint $table) {
            $table->id('intervention_id'); // Primary key
            $table->foreignId('client_id')->references('client_id')->on('clients')->onDelete('cascade');
            $table->date('intervention_date'); // Date of the intervention
            $table->text('comment')->nullable(); // Additional notes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interventions');
    }
};