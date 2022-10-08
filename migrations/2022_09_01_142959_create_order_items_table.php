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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('item');
            $table->double('rate', 30, 10);
            $table->double('quantity', 30, 10);
            $table->double('discount', 30, 10);
            $table->double('foc_quantity', 30, 10);
            $table->double('foc_tax', 30, 10)->nullable();
            $table->double('invoice_discount', 30, 10)->nullable();
            $table->string('tax_rule');
            $table->double('tax_percentage', 30, 10);
            $table->double('factor', 30, 10);
            $table->enum('status', ['Pending','Confirmed', 'Approved', 'Cancelled']);
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
        Schema::dropIfExists('order_items');
    }
};
