<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use PDF;

class PDFController extends Controller
{
    /**
     * Download PDF internal.
     */
    public function generate($id)
    {
        $produk = ProdukHukum::find($id);
        $pdf = PDF::loadView('pdf', compact('produk'))->setPaper($produk->paper);
        return $pdf->download('SK-'.trim($produk->nomor).'-'.trim($produk->tahun).'.pdf');
    }

    /**
     * Download Page.
     */
    public function public($key)
    {
        $produk = ProdukHukum::where('kode_acak', trim($key))->firstOrFail();
        if ($produk) {
            return view('download', [
                'produk' => $produk
            ]);
        }
    }

    /**
     * Download PDF public.
     */
    public function downloadPDF(Request $request)
    {
        if ($request->has('_key') && $request->has('sandi')) {
            $key = $request->input('_key');
            $passwd = $request->input('sandi');
            $produk = ProdukHukum::where('kode_acak', trim($key))->firstOrFail();
            if (false !== $produk && $passwd === $produk->sandi) {
                $pdf = PDF::loadView('pdf', compact('produk'))->setPaper($produk->paper);
                return $pdf->download('SK-'.trim($produk->nomor).'-'.trim($produk->tahun).'.pdf');
            }

            return redirect('/unduh/publik/'.$key)->with('error', 'Kata sandi tidak tepat!');
        }

        return false;
    }
}
