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
        Schema::create('phrase_category_to_phrase', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('phrase_id');
            $table->foreignUuid('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrase_category_to_phrase');
    }
};
