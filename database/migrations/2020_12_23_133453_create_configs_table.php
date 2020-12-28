<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->integer('late_charge');
            $table->integer('loan_deadline');
            $table->integer('book_list_page');
            $table->integer('member_list_page');
            $table->integer('librarian_list_page');
            $table->integer('ebook_list_page');
            $table->integer('publisher_list_page');
            $table->integer('category_list_page');
            $table->integer('permission_list_page');
            $table->integer('transaction_list_page');
            $table->integer('report_list_page');
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
        Schema::dropIfExists('configs');
    }
}
