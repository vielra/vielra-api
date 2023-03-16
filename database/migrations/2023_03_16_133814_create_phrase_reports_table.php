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
        Schema::create('phrase_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('phrase_id');
            $table->foreignUuid('user_id')->nullable();
            $table->unsignedTinyInteger('report_type_id');
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrase_reports');
    }
};
