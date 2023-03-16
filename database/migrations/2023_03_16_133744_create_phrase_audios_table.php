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
        Schema::create('phrase_audios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('audio_url');
            $table->enum('locale', ['vi', 'en', 'id'])->default('vi')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->foreignUuid('phrase_id');
            // $table->enum('voice_code', config('app.phrase_voice_codes'));
            $table->unsignedTinyInteger('speech_name_id')->nullable();
            $table->boolean('is_initial')->default(false);
            $table->string('mime_type', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phrase_audios');
    }
};
