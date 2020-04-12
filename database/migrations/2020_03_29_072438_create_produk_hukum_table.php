<?php

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukHukumTable extends Migration
{
    use SoftDeletes;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_hukum', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('nomor', 5);
            $table->year('tahun');
            $table->mediumText('judul');
            $table->longText('isi');
            $table->smallInteger('tipe')->default(1);
            $table->char('kota', 50)->default('Jakarta');
            $table->date('tanggal')->default(now());
            $table->date('retensi')->nullable();
            $table->string('sandi', 10);
            $table->smallInteger('status')->default(0);
            $table->string('qrcode', 100)->nullable();
            $table->string('kode_acak', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk_hukum');
    }
}
