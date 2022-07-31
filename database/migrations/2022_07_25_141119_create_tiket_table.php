<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketTable extends Migration
{
    public function up()
    {
        Schema::create('tiket', function (Blueprint $table) {
            $table->id();
            $table->string('no_tiket');
            $table->foreignId('id_mahasiswa')->constrained('mahasiswa');
            $table->foreignId('id_staff')->constrained('staff');
            $table->text('keterangan');
            $table->date('verifikasi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tiket');
    }
}
