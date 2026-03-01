<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_toko', function (Blueprint $table) {
            $table->id();
            $table->string('nama_toko')->default('AutoClean');
            $table->string('logo');
            $table->string('favicon');
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->text('tentang_kami')->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('jam_buka_pekan')->nullable();
            $table->string('jam_buka_akhir_pekan')->nullable();
            $table->text('url_map')->nullable();
            $table->text('url_embed')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_toko');
    }
};
