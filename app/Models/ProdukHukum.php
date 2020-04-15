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
        'extra',
        'retensi',
        'status',
        'sandi',
        'qrcode',
        'kode_acak',
    ];

    protected $casts = [
        'extra' => 'array',
    ];

    public function getExtraAttribute($extra)
    {
        return array_values(json_decode($extra, true) ?: []);
    }

    public function setExtraAttribute($extra)
    {
        $this->attributes['extra'] = json_encode(array_values($extra));
    }
}
