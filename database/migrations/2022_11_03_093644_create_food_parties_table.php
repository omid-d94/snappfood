<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_parties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("food_id");
            $table->unsignedInteger("count");
            $table->time("expire");
            $table->unsignedBigInteger("discount_id");
            $table->foreign("food_id")
                ->references("id")
                ->on("foods")
                ->onDelete("cascade");
            $table->foreign("discount_id")
                ->references("id")
                ->on("discounts")
                ->onDelete("cascade");
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
        Schema::dropIfExists('food_parties');
    }
};
