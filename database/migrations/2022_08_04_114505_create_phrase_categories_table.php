<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhraseCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrase_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->json('name');
            $table->string('slug', 100)->unique();
            $table->string('color', 50)->nullable();
            $table->string('icon_name', 50)->nullable();
            $table->enum('icon_type', config('app.app_icon_types'))->nullable();
            $table->boolean('is_initial')->default(false);
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
        Schema::dropIfExists('phrase_categories');
    }
}
