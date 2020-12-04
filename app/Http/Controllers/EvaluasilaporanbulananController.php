<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use App\eproc;

//use App\Imports\MeaImportCollection;

use Illuminate\Support\Facades\DB;

//use Excel;

use Auth;

//use Mail;

use PDF;


class EvaluasilaporanbulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('layout.e-proc');
		
    }
	
	public function print(Request $request)
    {
        //
		//$thn_print=$request->thn_eproc;
 
    	//$pdf = PDF::loadview('layout.print_eproc',['thn_print'=>$thn_print])->setPaper('legal', 'landscape');
    	//return $pdf->stream('print_eproc.pdf');
		
	}
}	