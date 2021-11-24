<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('department')->nullable();
            $table->integer('tender_id')->nullable();
            $table->string('ra_bill')->nullable();
            $table->integer('security')->nullable();
            $table->integer('income_tax')->nullable();
            $table->integer('cgst')->nullable();
            $table->integer('sgst')->nullable();
            $table->integer('igst')->nullable();
            $table->integer('labour_cess')->nullable();
            $table->integer('withheld')->nullable();
            $table->integer('recovery')->nullable();
            $table->integer('total_deductions')->nullable();
            $table->integer('gross_amount')->nullable();
            $table->string('cheque_amount')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
