<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->string('answer');
            $table->unsignedBigInteger('answer_type_id');
            $table->json('answer_list')->nullable();
            $table->foreign('answer_type_id')->references('id')->on('answer_types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('question_category_id')->references('id')->on('question_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('question_category_id');
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
        Schema::dropIfExists('answers');
    }
};
