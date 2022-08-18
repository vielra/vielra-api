<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipPhraseCategoriesToPhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('phrases', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('phrase_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phrases', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
    }
}
