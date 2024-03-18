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
        Schema::create('accomodation_options', function (Blueprint $table) {
            $table->timestamps();
            $table->primary(['option_id', 'accomodation_id']);
            $table->foreignId('option_id')->constrained()->onDelete('cascade');
            $table->foreignId('accomodation_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accomodation_options');
    }
};
