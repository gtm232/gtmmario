<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\perencanaan;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class PerencanaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$tahundashboard=date('Y');
		return view('layout.perencanaan',compact('tahundashboard'));
		

    }
	
	public function perencanaan_tahun(Request $request)
    {
        //
		$tahundashboard=$request->tahundashboard;
		return view('layout.perencanaan',compact('tahundashboard'));
    }
	
	 public function pac(Request $request)
    {
        //
		$pekerjaanaccrue=1; 
		$tahundashboard=$request->tahundashboard;
		return view('layout.pekerjaan',compact('pekerjaanaccrue','tahundashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
		return view('input.perencanaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		DB::table('perencanaan')->insert([
			'nama_pekerjaan' => $request->nama_pekerjaan,
			'bulan' => $request->bulan,
			'sampai_bulan' => $request->sampai_bulan,
			'tahun' => $request->tahun,
			
			]);
	
		
		
		return redirect()->route('perencanaan.index')->with('success','Berhasil di Simpan');
		
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(perencanaan $perencanaan)
    {
        //
		return view('edit.perencanaan',compact('perencanaan',$perencanaan));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
		
		perencanaan::find($id)->update([
		'nama_pekerjaan' => $request->nama_pekerjaan,
		'bulan' => $request->bulan,
		'sampai_bulan' => $request->sampai_bulan,
		'tahun' => $request->tahun,
		]);
		
		return redirect()->route('perencanaan.index')->with('success','Berhasil di Simpan');
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		
		perencanaan::find($id)->delete();
		return redirect()->route('perencanaan.index')->with('hapus','Berhasil delete');
    }
	
	public function hanya_saya()
    {
        //
		$pekerjaan=pekerjaan::all();
		$hanya_saya=1;
		return view('layout.pekerjaan',compact('pekerjaan'),compact('hanya_saya'));
    }
	public function carifile(Request $request)
    {
        //
		$pekerjaan=pekerjaan::all();
		$carifile=$request->jenisdokumen;
		return view('layout.pekerjaan',compact('pekerjaan'),compact('carifile'));
    }
}
