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
        Schema::create('accomodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('type');
            $table->float('price', 6, 2);
            $table->tinyInteger('dispo');
            $table->string('address');
            $table->integer('cp');
            $table->string('city');
            $table->string('country');
            $table->float('superficy', 5, 2);
            $table->integer('rooms');
            $table->integer('beds');
            $table->integer('persons');
            $table->float('note', 3, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodations');
    }
};
