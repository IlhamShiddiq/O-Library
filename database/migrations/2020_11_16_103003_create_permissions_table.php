<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_ebook');
            $table->text('reason');
            $table->char('confirmed', 1);
            $table->char('accepted', 1)->nullable();
            $table->date('submit_date');
            $table->date('limit_date')->nullable();
            $table->text('reason_for_rejection')->nullable();
            $table->timestamps();

            $table->foreign('id_member')->references('id')->on('members');
            $table->foreign('id_ebook')->references('id')->on('ebooks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
