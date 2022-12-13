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
        Schema::table('restaurants', function (Blueprint $table) {
            $table->text('address')->change();
            $table->float('latitude', 10, 6);
            $table->float('longitude', 10, 6);
            $table->unsignedBigInteger("schedule")->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->json("address")->change();
            $table->json("schedule")->change();
            $table->dropColumn(["latitude", "longitude"]);
        });
    }
};
