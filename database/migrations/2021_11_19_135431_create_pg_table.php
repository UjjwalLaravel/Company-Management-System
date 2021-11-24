<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg', function (Blueprint $table) {
            $table->id();
            $table->string('instrument_no')->nullable();
            $table->string('instrument_date')->nullable();
            $table->string('instrument_type')->nullable();
            $table->string('instrument_amount')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('tender_id')->nullable();
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
        Schema::dropIfExists('pg');
    }
}
