<?php

namespace App\Http\Controllers;

use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use DataTables;

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
                    $btn = '<a href="/unduh/publik/'.$row->kode_acak.'" class="edit btn btn-primary btn-sm" target="_blank">Unduh</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('home');
    }
}
