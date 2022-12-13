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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("raw_material")->nullable();
            $table->decimal("price");
            $table->string("image_path")->nullable();
            $table->unsignedBigInteger("restaurant_id");
            $table->unsignedBigInteger("food_category");

            $table->foreign("restaurant_id")
                ->references("id")
                ->on("restaurants")
                ->onDelete("cascade");

            $table->foreign("food_category")
                ->references("id")
                ->on("food_categories")
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
        Schema::dropIfExists('foods');
    }
};
