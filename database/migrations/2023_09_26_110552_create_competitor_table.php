<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
        {
            Schema::create('competitor', function (Blueprint $table) {
                $table->string('name', 200);
                $table->string('email', 200);
                $table->integer('round_id')->unsigned();
                $table->primary(['name', 'email']);
                $table->foreign('round_id')->references('id')->on('round')->onDelete('cascade');
            });
        }

        public function down()
        {
            Schema::dropIfExists('competitor');
        }
};
