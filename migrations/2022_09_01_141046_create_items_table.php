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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('displayname', 256);
            $table->double('rate', 30, 10);
            $table->double('minimum_rate_allowed', 30, 10);
            $table->double('stock', 30, 10);
            $table->string('tax_rule');
            $table->string('unit');
            $table->string('barcode');
            $table->double('factor', 30, 10);
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
        Schema::dropIfExists('items');
    }
};
