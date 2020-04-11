<?php

namespace App\Admin\Extensions;

use Encore\Admin\Grid\Exporters\ExcelExporter;

class ProdukHukumExporter extends ExcelExporter
{
    protected $fileName = 'produk_hukum.xlsx';

    protected $columns = [
        'id' => 'ID',
        'nomor' => 'Nomor',
        'tahun' => 'Tahun',
        'judul' => 'Judul/Tentang',
    ];
}
