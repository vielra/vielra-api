<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhraseAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrase_audios', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('audio_url');
            $table->enum('locale', ['vi', 'en', 'id'])->default('vi');
            $table->foreignUuid('user_id')->nullable();
            $table->foreignUuid('phrase_id');
            $table->enum('voice_code', config('app.phrase_voice_codes'));
            $table->boolean('is_initial')->default(false);
            $table->string('mime', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrase_audio');
    }
}
