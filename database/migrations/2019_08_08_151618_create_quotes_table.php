<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('parent_id');
            $table->string('eventName');
            $table->date('eventDate');
            $table->dateTime('eventTime');
            $table->date('eventFinishDate');
            $table->dateTime('eventFinishTime');
            $table->float('price');
            $table->string('status');
            $table->integer('peopleQty');
            $table->date('validThru');
            $table->integer('receiptsQty');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
