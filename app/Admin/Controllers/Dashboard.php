<?php

namespace App\Admin\Controllers;

use App\Models\ProdukHukum;
use Encore\Admin\Widgets\InfoBox;

class Dashboard
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function title()
    {
        return view('admin.dashboard.title');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function description()
    {
        return view('admin.dashboard.description');
    }

    public static function infoTotal()
    {
        $produk = new ProdukHukum();
        $total = $produk->count();
        $infoBox = new InfoBox('Total Surat', 'book', 'aqua', '/admin/produk_hukum', $total);
        return $infoBox->render();
    }

    public static function infoActive()
    {
        $produk = new ProdukHukum();
        $total = $produk::where('status', 1)->count();
        $infoBox = new InfoBox('Surat Aktif', 'check', 'green', '/admin/produk_hukum?&status[]=1', $total);
        return $infoBox->render();
    }

    public static function infoDraft()
    {
        $produk = new ProdukHukum();
        $total = $produk::where('status', 0)->count();
        $infoBox = new InfoBox('Surat Draf', 'bookmark', 'orange', '/admin/produk_hukum?&status[]=0', $total);
        return $infoBox->render();
    }

    public static function infoChart()
    {
        $produk = new ProdukHukum();
        $years = $produk->distinct('tahun')->get('tahun')->sort();
        $arrLabels = [];
        $arrDatasets = [];
        $arrBgColor = [];
        $arrBorderColor = [];
        $backgroundColor = [
            '#3b90ff',
            '#bc4555',
            '#fa1e3c',
            '#b1bb78',
            '#eed59a',
            '#dd823b',
            '#ccaf0b',
            '#9b4dca',
            '#606c76',
            '#00ffff',
            '#b4eeb4',
            '#c0d6e4',
            '#f1d152',
            '#2e8b57'
        ];

        foreach ($years as $year) {
            $total = $produk::where('tahun', $year->tahun)->count();
            $bgColor = $backgroundColor[array_rand($backgroundColor)];
            $border = 'black';
            array_push($arrLabels, $year->tahun);
            array_push($arrDatasets, $total);
            array_push($arrBgColor, $bgColor);
            array_push($arrBorderColor, $border);
        }

        $result = [
            'labels' => $arrLabels,
            'datasets' => $arrDatasets,
            'bg_colors' => $arrBgColor,
            'border_colors' => $arrBorderColor,
        ];

        return view('admin.charts.bar', ['data' => $result]);
    }
}
