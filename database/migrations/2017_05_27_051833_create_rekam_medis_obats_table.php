<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRekamMedisObatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekam_medis_obats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('obat_id')->unsigned()->nullable();
            $table->integer('rekam_medis_id')->unsigned()->nullable();

            $table->foreign('obat_id')->references('id')->on('obats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rekam_medis_id')->references('id')->on('rekam_medis')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::table('rekam_medis_obats', function (Blueprint $table) {
            $table->dropForeign(['obat_id']);
            $table->dropForeign(['rekam_medis_id']);
        });
        Schema::dropIfExists('rekam_medis_obats');
    }
}
