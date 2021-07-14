<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('following_id');
            $table->unsignedBigInteger('follower_id');

            $table->foreign('following_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('follower_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // Not allowing to have the same combination of these IDs.
            $table->unique(['following_id', 'follower_id']);

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
        Schema::dropIfExists('follows');
    }
}
