<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnsemblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensembles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('headline', 100);
            $table->text('introduction');
            $table->string('piece', 100);
            $table->string('composer', 100);
            $table->text('music_sheet');

            $table->integer('violin')->nullable();
            $table->integer('viola')->nullable();
            $table->integer('cello')->nullable();
            $table->integer('contrabass')->nullable();

            $table->integer('flute')->nullable();
            $table->integer('oboe')->nullable();
            $table->integer('clarinet')->nullable();
            $table->integer('bassoon')->nullable();
            $table->integer('saxophone')->nullable();

            $table->integer('trumpet')->nullable();
            $table->integer('horn')->nullable();
            $table->integer('trombone')->nullable();
            $table->integer('tuba')->nullable();

            $table->integer('piano')->nullable();
            $table->integer('harp')->nullable();
            $table->integer('timpani')->nullable();
            $table->integer('snare_drum')->nullable();
            $table->integer('bass_drum')->nullable();
            $table->integer('tambourine')->nullable();
            $table->integer('triangle')->nullable();

            $table->dateTime('deadline');
            $table->text('notes')->nullable();

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
        Schema::dropIfExists('ensembles');
    }
}
