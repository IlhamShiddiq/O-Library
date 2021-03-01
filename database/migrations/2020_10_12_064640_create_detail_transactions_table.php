<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('book_id');
            $table->date('date_of_return');
            $table->char('status', 1);
            $table->timestamp('last_warned')->nullable();
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transactions');
    }
}
