<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('id');
            $table->char('isbn', 20)->nullable();
            $table->string('title');
            $table->unsignedBigInteger('publisher_id');
            $table->string('author');
            $table->unsignedBigInteger('category_id');
            $table->integer('qty');
            $table->string('image');
            $table->text('about')->nullable();
            $table->char('publish_year', 4);
            $table->timestamps();

            $table->foreign('publisher_id')->references('id')->on('publishers');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
