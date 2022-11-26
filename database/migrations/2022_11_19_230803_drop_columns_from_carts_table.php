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
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn("cost");
            $table->dropForeign("carts_discount_id_foreign");
            $table->dropColumn("discount_id");
            $table->dropColumn("count");
            $table->dropColumn("total");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->unsignedDecimal("cost", 10);
            $table->unsignedDecimal("total", 12);
            $table->unsignedBigInteger("discount_id");
            $table->foreign("discount_id")
                ->references("id")
                ->on("discounts")
                ->onDelete("cascade");
            $table->unsignedInteger("count");
        });
    }
};
