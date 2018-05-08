<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advert_favorites', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->unsignedInteger('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE');
            $table->primary(['user_id', 'advert_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advert_favorites');
    }
}
