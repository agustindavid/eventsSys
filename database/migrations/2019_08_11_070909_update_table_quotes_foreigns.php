<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableQuotesForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('venue_id')->unsigned();
            $table->bigInteger('package_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
        $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
        $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            //
        });
    }
}
