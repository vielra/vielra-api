<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhrasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phrases', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('text_vi');
            $table->string('text_en')->nullable();
            $table->string('text_id')->nullable();
            $table->foreignUuid('user_id')->nullable();
            $table->foreignUuid('category_id');
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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phrases');
    }
}
