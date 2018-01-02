<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasienPoliTable extends Migration
{
    public function up()
    {
        Schema::create('pasien_poli', function (Blueprint $table){
            $table->increments('id');
            $table->integer('pasien_id')->unsigned()->nullable();
            $table->integer('poli_id')->unsigned()->nullable();
            $table->string('keluhan')->nullable();
            $table->foreign('pasien_id')->references('id')->on('pasiens')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('poli_id')->references('id')->on('polis')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::table('pasien_poli', function (Blueprint $table) {
            $table->dropForeign(['pasien_id']);
            $table->dropForeign(['poli_id']);
        });
        Schema::dropIfExists('pasien_poli');
    }
}
