<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\acrue; 

class AcrueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$acrue=acrue::all();
		return view('layout.acrue',compact('acrue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.acrue');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		 $tanggal_mulai=date('Y-m-d',strtotime($request->tanggal_mulai));
           $tanggal_berakhir=date('Y-m-d',strtotime($request->tanggal_berakhir));
		acrue::create([
		'tahun' => $request->tahun,
		'tanggal_mulai' => $tanggal_mulai,
		'tanggal_akhir' => $tanggal_berakhir,
		]);
		return redirect()->route('acrue.index')->with('success','Berhasil di Simpan');
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
    public function edit(acrue $acrue)
    {
        //
		return view('edit.acrue',compact('acrue',$acrue));
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
		$tanggal_mulai=date('Y-m-d',strtotime($request->tanggal_mulai));
           $tanggal_berakhir=date('Y-m-d',strtotime($request->tanggal_berakhir));
		acrue::find($id)->update([
		'tahun' => $request->tahun,
		'tanggal_mulai' => $tanggal_mulai,
		'tanggal_akhir' => $tanggal_berakhir,
		]);
		return redirect()->route('acrue.index')->with('success','Berhasil di Simpan');
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
		acrue::find($id)->delete();
		return redirect()->route('acrue.index')->with('hapus','Berhasil delete');
    }
}
