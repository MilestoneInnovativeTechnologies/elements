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
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin','executive'])->default('executive')->after('email');
            $table->enum('status', ['active','inactive'])->default('active');
        });
        $user = \App\Models\User::create(['name' => 'Administrator','email' => 'admin@admin.admin', 'password' => \Illuminate\Support\Facades\Hash::make('123456')]);
        $user->role = 'admin'; $user->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
