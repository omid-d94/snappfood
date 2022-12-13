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
        Schema::table('orders', function (Blueprint $table) {
            $table->tinyInteger("status");
            $table->dropForeign("orders_discount_id_foreign");
            $table->dropColumn("discount_id");
            $table->dropColumn("count");
            $table->dropColumn("cost");
            $table->unsignedBigInteger("restaurant_id");
            $table->foreign("restaurant_id")
                ->references("id")
                ->on("restaurants")
                ->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger("discount_id");
            $table->unsignedInteger("count");
            $table->unsignedDecimal("cost", 10);
            $table->foreign("discount_id")
                ->references("id")
                ->on("discounts")
                ->onDelete("cascade");
            $table->dropForeign("orders_restaurant_id_foreign");
            $table->dropColumn("restaurant_id");
            $table->dropColumn("status");
        });
    }
};
