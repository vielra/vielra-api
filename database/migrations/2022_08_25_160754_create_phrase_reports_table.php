<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhraseReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrase_reports');
    }
}
