<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Beranda')
            ->description('Sistem Informasi Produk Hukum (eProKum)')
            ->row(Dashboard::title())
            ->row(function (Row $row) {
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::infoTotal());
                });
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::infoActive());
                });
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::infoDraft());
                });
            })
            ->body(Dashboard::infoChart());
    }
}
