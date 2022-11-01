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
        Schema::create('transfer_comprovatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId("transfers_id")->references("id")->on("transfers");
            $table->string("name");
            $table->foreignId("auth_id")->references("id")->on("users");
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
        Schema::dropIfExists('transfer_comprovatives');
    }
};
