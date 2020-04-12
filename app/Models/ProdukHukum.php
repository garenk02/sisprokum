<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukHukum extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'produk_hukum';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor',
        'tahun',
        'judul',
        'isi',
        'tipe',
        'kota',
        'tanggal',
        'retensi',
        'status',
        'sandi',
        'qrcode',
        'kode_acak',
    ];
}
