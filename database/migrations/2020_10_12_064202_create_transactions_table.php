<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('librarian_id');
            $table->date('borrow_date');
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('librarian_id')->references('id')->on('librarians');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
