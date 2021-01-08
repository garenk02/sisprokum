<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = ProdukHukum::where(['status' => 1])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.URL::to('/prokum/'.$row->kode_acak).'" class="edit btn btn-primary btn-sm"><span style="color:white;font-weight:bold;">Detil</span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('home');
    }

    /**
     * Detail Page.
     */
    public function find($key)
    {
        $produk = ProdukHukum::where('kode_acak', trim($key))->firstOrFail();
        if ($produk) {
            return view('detail', [
                'produk' => $produk
            ]);
        }
    }
}
