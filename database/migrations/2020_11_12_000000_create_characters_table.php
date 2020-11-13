<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("favorite_characters", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->string("external_id");
            $table->bigInteger("user")->nullable();
            // $table
            //     ->foreign("user")
            //     ->references("id")
            //     ->on("users");
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
        Schema::dropIfExists("favorite_characters");
    }
}
