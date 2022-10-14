<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('order_date');
            $table->bigInteger('sales_executive');
            $table->bigInteger('customer');
            $table->string('reference_number', 256)->nullable();
            $table->enum('payment_mode', ['cash', 'credit']);
            $table->integer('credit_period')->nullable();
            $table->enum('foctax', ['Yes', 'No']);
            $table->double('invoice_discount', 30, 10);
            $table->enum('status', ['Pending','Confirmed', 'Approved', 'Cancelled', 'Inactive']);
            $table->text('narration')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
