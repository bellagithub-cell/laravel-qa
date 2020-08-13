<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title'); // setiap question ada title
            $table->string('slug')->unique(); // title that constructed to make pretty url
            $table->text('body'); // karena butuh excel content
            $table->unsignedInteger('views')->default(0); // untuk tau berapa banyak question diliat
            $table->unsignedInteger('answers')->default(0); // untuk tau berapa banyak answer dari question itu
            $table->integer('votes')->default(0); // untuk tau berapa banyak yg vote question
            $table->unsignedBigInteger('best_answer_id')->nullable(); // untuk liat best_answer 
            $table->unsignedBigInteger('user_id'); // untuk tau user yg create question
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // tiap kali user di delete, question yg berhubungan sama user juga kehapus
            // selesai ini table question sudah terbentuk
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
