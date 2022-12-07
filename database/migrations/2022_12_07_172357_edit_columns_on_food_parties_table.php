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
        Schema::table('food_parties', function (Blueprint $table) {
            $table->dropForeign("food_parties_discount_id_foreign");
            $table->dropForeign("food_parties_food_id_foreign");
            $table->dropColumn("count", "discount_id", "food_id");
            $table->renameColumn("expire", "start");
            $table->time("end");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_parties', function (Blueprint $table) {
            $table->unsignedInteger("count");
            $table->unsignedBigInteger("discount_id");
            $table->unsignedBigInteger("food_id");
            $table->dropColumn("end");
            $table->foreign("food_id")
                ->references("id")
                ->on("foods")
                ->onDelete("cascade");
            $table->foreign("discount_id")
                ->references("id")
                ->on("discounts")
                ->onDelete("cascade");
            $table->renameColumn("start", "expire");
        });
    }
};
