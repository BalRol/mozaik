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
       Schema::create('competitor', function (Blueprint $table) {
           $table->string('name', 200);
           $table->string('email', 200);
           $table->integer('round_id')->unsigned();
           $table->foreign('round_id')->references('id')->on('round')->onDelete('cascade');
           $table->primary(['name', 'email']);
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
        Schema::dropIfExists('competitor');
    }
};
