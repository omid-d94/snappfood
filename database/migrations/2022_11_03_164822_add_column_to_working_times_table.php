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
        Schema::table('working_times', function (Blueprint $table) {
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
        Schema::table('working_times', function (Blueprint $table) {
            $table->dropForeign("working_times_restaurant_id_foreign");
            $table->dropColumn("restaurant_id");
        });
    }
};
