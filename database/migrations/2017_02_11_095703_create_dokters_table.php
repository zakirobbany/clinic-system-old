<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoktersTable extends Migration
{
    public function up()
    {
        Schema::create('dokters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('display_name');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('no_telepon');
            $table->string('email');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('dokters');
    }
}