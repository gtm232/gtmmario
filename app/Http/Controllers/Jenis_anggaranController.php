<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\jenis_anggaran;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class Jenis_anggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('layout.jenis_anggaran');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.jenis_anggaran');
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
            'jenis_anggaran' => $request->jenis_anggaran,
			  );
		$id_jenis_anggaran=DB::table('jenis_anggaran')->insertGetId($data);
		
		return redirect()->route('jenis_anggaran.index')->with('success','Berhasil di Simpan');
		
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
    public function edit(jenis_anggaran $jenis_anggaran)
    {
        //
		return view('edit.jenis_anggaran',compact('jenis_anggaran',$jenis_anggaran));
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
		
		jenis_anggaran::find($id)->update([
			'jenis_anggaran' => $request->jenis_anggaran,
		]);
		
		return redirect()->route('jenis_anggaran.index')->with('success','Berhasil di Simpan');
		
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
		jenis_anggaran::find($id)->delete();
		return redirect()->route('jenis_anggaran.index')->with('hapus','Berhasil delete');
    }
	
}
