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
            $table->id();
            $table->unsignedBigInteger('exam_id');
            $table->integer('serial');
            $table->string('title');
            $table->text('ans');
            $table->double('marks', 8, 2)->nullable();
            $table->enum('type', ['Multiple Choice','Written'])->default('Multiple choice');
            $table->enum('status', ['Active','Inactive'])->default('Active');
            $table->integer('created_by')->nullable();

            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');

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
        Schema::dropIfExists('questions');
    }
}
