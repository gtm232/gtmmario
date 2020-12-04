<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\peringatan;

class PeringatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$peringatan=peringatan::all();
		return view('layout.peringatan',compact('peringatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit(peringatan $peringatan)
    {
        //
		return view('edit.peringatan',compact('peringatan',$peringatan));
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
		peringatan::find($id)->update([
		'nama_pekerjaan' => $request->nama_pekerjaan,
		'tanggal_mulai' => date('Y-m-d',strtotime($request->tanggal_mulai)),
		'tanggal_berakhir' => date('Y-m-d',strtotime($request->tanggal_berakhir)),
		'lokasi' => $request->lokasi,
		'pic' => $request->pic,
		'status' => $request->status,
		]);
		return redirect()->route('peringatan.index')->with('success','Berhasil di Simpan');
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
    }
}
