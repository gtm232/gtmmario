<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\jenis_pekerjaan;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class Jenis_pekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('layout.jenis_pekerjaan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.jenis_pekerjaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
        $data = array(
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
			  );
		$id_laporan_pekerjaan=DB::table('jenis_pekerjaan')->insertGetId($data);
		
		return redirect()->route('jenis_pekerjaan.index')->with('success','Berhasil di Simpan');
		
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
    public function edit(jenis_pekerjaan $jenis_pekerjaan)
    {
        //
		return view('edit.jenis_pekerjaan',compact('jenis_pekerjaan',$jenis_pekerjaan));
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
		
		jenis_pekerjaan::find($id)->update([
			'jenis_pekerjaan' => $request->jenis_pekerjaan,
		]);
		
		return redirect()->route('jenis_pekerjaan.index')->with('success','Berhasil di Simpan');
		
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
		jenis_pekerjaan::find($id)->delete();
		return redirect()->route('jenis_pekerjaan.index')->with('hapus','Berhasil delete');
    }
	
}
