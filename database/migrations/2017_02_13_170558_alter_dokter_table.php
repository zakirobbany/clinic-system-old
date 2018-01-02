<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AlterDokterTable extends Migration
{
    public function up()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }
    public function down()
    {
        Schema::table('dokters', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
    }
}