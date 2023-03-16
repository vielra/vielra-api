<?php

use App\Models\PhraseCategory;
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
        Schema::create('phrase_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('name');
            $table->string('slug', 100)->unique();
            $table->string('color', 50)->nullable();
            $table->string('mobile_icon', 50)->nullable();
            $table->enum('mobile_icon_type', PhraseCategory::LIST_MOBILE_ICONS)->nullable();
            $table->string('web_icon', 50)->nullable();
            $table->string('image_url')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_initial')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrase_categories');
    }
};
