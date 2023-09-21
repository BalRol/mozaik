<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('round', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('location', 200);
            $table->date('date');
            $table->string('competition_name', 200);
            $table->year('competition_year');
            $table->foreign(['competition_name', 'competition_year'])->references(['name', 'year'])->on('competition')->onDelete('cascade');
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
        Schema::dropIfExists('round');
    }
};
