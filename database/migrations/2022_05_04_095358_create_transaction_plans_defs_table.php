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
        Schema::create('transaction_plans_defs', function (Blueprint $table) {
            $table->id();
            $table->boolean("active");
            $table->float("min_val");
            $table->float("max_val");
            $table->integer("min_tansactions");
            $table->float("percentage");
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
        Schema::dropIfExists('transaction_plans_defs');
    }
};
