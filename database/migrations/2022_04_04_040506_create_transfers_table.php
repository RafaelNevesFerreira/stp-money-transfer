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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("country");
            $table->string("address");
            $table->date("receveid_at")->nullable();
            $table->float("value_sended");
            $table->string("currency");
            $table->boolean("plans");
            $table->string("transfer_code")->unique();
            $table->string("status")->default("sended");
            $table->string("destinatary_name");
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
        Schema::dropIfExists('transfers');
    }
};
