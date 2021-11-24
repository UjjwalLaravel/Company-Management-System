<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('nit_no')->nullable();
            $table->string('est_cost');
            $table->string('tendered_amount')->nullable();
            $table->text('name_of_work');
            $table->integer('tender_status');
            $table->string('date_of_start')->nullable();
            $table->string('date_of_start_agreement')->nullable();
            $table->string('date_of_completion_agreement')->nullable();
            $table->string('remarks')->nullable();
            $table->string('percent_below')->nullable();
            $table->string('project_type');
            $table->string('date_of_completion')->nullable();
            $table->string('pg_status')->nullable();
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
        Schema::dropIfExists('tenders');
    }
}
