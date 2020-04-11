<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate($id)
    {
        $produk = ProdukHukum::find($id);
        $pdf = PDF::loadView('pdf', compact('produk'));
        return $pdf->download('SK-'.$produk->nomor.'-'.$produk->tahun.'.pdf');
    }
}
