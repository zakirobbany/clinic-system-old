<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPasienPoliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pasien_poli', function (Blueprint $table) {
            $table->integer('dokter_id')->unsigned()->nullable();
            $table->foreign('dokter_id')->references('id')->on('dokters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pasien_poli', function (Blueprint $table) {
            $table->dropForeign(['dokter_id']);
        });
    }
}
