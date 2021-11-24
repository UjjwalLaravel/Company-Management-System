<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->string('company_name');
            $table->string('invoice_no');
            $table->string('net_amount');
            $table->string('cgst');
            $table->string('sgst');
            $table->string('total_gst');
            $table->string('gross_amount');
            $table->timestamps();
        });
        // Schema::table('tenders', function (Blueprint $table) {
        //     $table->string('nit_no')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
