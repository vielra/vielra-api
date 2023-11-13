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
        Schema::create('phrases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('text_vi');
            $table->text('text_en')->nullable();
            $table->text('text_id')->nullable();
            $table->foreignUuid('user_id')->nullable();
            // $table->foreignUuid('category_id');
            $table->unsignedTinyInteger('status_id');
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_initial')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->foreignUuid('confirmed_by_user_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrases');
    }
};
