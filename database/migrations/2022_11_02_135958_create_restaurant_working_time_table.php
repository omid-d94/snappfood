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
        Schema::create('restaurant_working_time', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("restaurant_id");
            $table->unsignedBigInteger("working_time_id");
            $table->foreign("working_time_id")
                ->references("id")
                ->on("working_times")
                ->onDelete("cascade");
            $table->foreign("restaurant_id")
                ->references("id")
                ->on("restaurants")
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
        Schema::dropIfExists('restaurant_working_time');
    }
};
