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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->index('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('nip')->unique()->nullable()->default(null);
            $table->bigInteger('nisn')->unique()->nullable()->default(null);
            $table->string('tempat_lahir')->nullable()->default(null);
            $table->date('tanggal_lahir')->nullable()->default(null);
            $table->enum('jenis_kelamin', ['p', 'l'])->nullable()->default(null);
            $table->string('poto')->nullable()->default(null);
            $table->string('agama')->nullable()->default(null);
            $table->unsignedBigInteger('kelas_id');
          
        //Table Kelas Tidak ada
        // $table->index('kelas_id');
        // $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            // $table->string('kelas')->nullable()->default(null);
            $table->text('alamat')->nullable()->default(null);
            $table->timestamps();
        });

        // $table->id();
        // $table->string('nama_poin');
        // $table->unsignedBigInteger('aspek_id');
        // $table->index('aspek_id');
        // $table->foreign('aspek_id')->references('id')->on('aspek')->onDelete('cascade');
        // $table->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biodata', function (Blueprint $table) {
            //
        });
    }
};