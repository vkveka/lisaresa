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
            $table->string('name', 40);
            $table->text('description', 10000);
            $table->enum('type', ['maison', 'appartement']);
            $table->float('price', 7, 2);
            $table->tinyInteger('dispo');
            // $table->boolean('dispo');
            $table->string('address', 200);
            $table->string('cp', 20);
            $table->string('city', 50);
            $table->string('country', 20);
            $table->float('superficy', 5, 2);
            $table->integer('rooms');
            $table->integer('beds');
            $table->integer('persons');
            $table->float('note', 2, 1)->nullable();
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
