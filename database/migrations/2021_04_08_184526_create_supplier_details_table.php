<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('created_by');
            $table->string('brand_name', 100);
            $table->string('poc_name', 26);
            $table->string('poc_mobile', 10);
            $table->string('gst_number', 15);
            $table->string('gst_certificate', 100);
            $table->string('pan_number', 25);
            $table->string('pan_card', 100);
            $table->string('bank_name', 100);
            $table->string('acholder_name', 26);
            $table->string('account_number', 18);
            $table->string('ifsc_code', 11);
            $table->string('cancelled_cheque', 100);
            $table->unsignedTinyInteger('cod');
            $table->unsignedTinyInteger('return_type');
            $table->unsignedTinyInteger('exchange_type');
            $table->string('sla_min', 50);
            $table->string('sla_max', 50);
            $table->unsignedTinyInteger('aggregator');
            $table->string('aggregator_commission')->nullable();
            $table->unsignedInteger('plan_id');
            $table->string('order_guarantee', 100);
            $table->unsignedTinyInteger('replica_supplier');
            $table->unsignedTinyInteger('supplier_type');
            $table->unsignedTinyInteger('primary_category');
            $table->unsignedTinyInteger('secondary_category');
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
        Schema::dropIfExists('supplier_details');
    }
}
