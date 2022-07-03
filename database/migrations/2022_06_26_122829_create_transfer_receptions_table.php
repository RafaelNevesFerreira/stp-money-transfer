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
        Schema::create('transfer_receptions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("last_name");
            $table->date("birthday_date");
            $table->string("nationality");
            $table->foreignId("transfer_id")->references("id")->on("transfers");
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
        Schema::dropIfExists('transfer_receptions');
    }
};
