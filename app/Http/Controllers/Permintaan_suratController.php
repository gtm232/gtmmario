<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\permintaan_surat;

use Illuminate\Support\Facades\DB;

class Permintaan_suratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$permintaan_surat=permintaan_surat::all();
		return view('layout.permintaan_surat',compact('permintaan_surat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.permintaan_surat');
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
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_dokumen_laporan	="(".$acak.") ".request()->file->getClientOriginalName();
		request()->file->move(public_path('permintaan_surat'),$nama_dokumen_laporan);
		}else{
		$nama_dokumen_laporan="";
		}
		permintaan_surat::create([
		'perihal_permintaan' => $request->perihal_permintaan,
		'file' => $nama_dokumen_laporan,
		]);
		return redirect()->route('permintaan_surat.index')->with('success','Berhasil di Simpan');
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
    public function edit(permintaan_surat $permintaan_surat)
    {
        //
		return view('edit.edit_permintaan_surat',compact('permintaan_surat',$permintaan_surat));
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
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_dokumen	="(".$acak.") ".request()->file->getClientOriginalName();
		request()->file->move(public_path('permintaan_surat'),$nama_dokumen);
		unlink(public_path('permintaan_surat/'.request()->file_old));
		}else{
		$nama_dokumen=request()->file_old;
		}
		permintaan_surat::find($id)->update([
		'perihal_permintaan' => $request->perihal_permintaan,
		'file' => $nama_dokumen,
		]);
		return redirect()->route('permintaan_surat.index')->with('success','Berhasil di Simpan');
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
		$hf=DB::table('permintaan_surat')->where('id',$id)->get()->first();
		unlink(public_path('permintaan_surat/'.$hf->file));
		permintaan_surat::find($id)->delete();
		return redirect()->route('permintaan_surat.index')->with('hapus','Berhasil delete');
    }
	
	public function refresh_permintaan_surat(Request $request)
    {
        //
		$pm=DB::table('pembuatan_surat')->where('id_laporan_pekerjaan',$request->id)->get();
		echo "<select name='pembuatan_surat' class='form-control'>
			  <option>--pilih--</option>
		";
		foreach($pm as $pm){
		echo "
			<option value='".$pm->id."'>".$pm->perihal."</option>
		";
		}
		echo "</select>";
    }
	
}
