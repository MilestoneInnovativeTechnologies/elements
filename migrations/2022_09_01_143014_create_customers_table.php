<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('display_name', 256);
            $table->integer('credit_period');
            $table->double('order_total', 30, 10);
            $table->double('outstanding', 30, 10);
            $table->double('maximum_allowed', 30, 10);
            $table->double('buffer', 30, 10);
            $table->timestamps();
        });
        DB::unprepared(Storage::get('customers_insert.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
