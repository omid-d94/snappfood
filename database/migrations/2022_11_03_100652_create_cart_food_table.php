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
        Schema::create('cart_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("food_id");
            $table->unsignedBigInteger("cart_id");
            $table->foreign("food_id")
                ->references("id")
                ->on("foods")
                ->onDelete("cascade");
            $table->foreign("cart_id")
                ->references("id")
                ->on("carts")
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
        Schema::dropIfExists('cart_food');
    }
};
