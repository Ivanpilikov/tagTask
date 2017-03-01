<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('image_name');
            $table->string('title');
            $table->date('created_date');
            $table->text('text');
            $table->boolean('published')->default(false);
            $table->integer('cat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('cat_id')->references('id')->on('categories')->onUpdate('restrict')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('restrict')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
