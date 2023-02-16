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
        Schema::create('incorrect_answers', function (Blueprint $table) {
            $table->id();
            $table->string('incorrect_answer');
            $table->foreign('answer_id')->references('id')->on('answers')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('answer_id');
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
        Schema::dropIfExists('incorrect_answers');
    }
};
