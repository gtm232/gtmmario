<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\suratsurat;

use Illuminate\Support\Facades\DB;

class SuratsuratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$suratsurat=suratsurat::all();
		return view('layout.suratsurat',compact('suratsurat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.suratsurat');
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
			if($request->jenis_surat == 'Surat Keluar'){
				$file	="(".$acak.") ".request()->file->getClientOriginalName();
				request()->file->move(public_path('surat_keluar'),$file);
			}else{
				$file	="(".$acak.") ".request()->file->getClientOriginalName();
				request()->file->move(public_path('surat_masuk'),$file);
			}
		}else{
		$file="";
		}
		suratsurat::create([
		'no_surat' => $request->no_surat,
		'perihal' => $request->perihal,
		'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
		'lokasi' => $request->arsip,
		'file' => $file,
		'jenis_surat' => $request->jenis_surat,
		
		
		]);
		return redirect()->route('suratsurat.index')->with('success','Berhasil di Simpan');
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
    public function edit(suratsurat $suratsurat)
    {
        //
		return view('edit.suratsurat',compact('suratsurat',$suratsurat));
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
		$file2=$request->file2;
		if(request()->file2 != null){
		$file	="(".$acak.") ".$file2->getClientOriginalName();
		request()->file2->move(public_path('suratsurat1'),$file);
		unlink(public_path('suratsurat1/'.request()->file_old));
		}else{
		$file=request()->file_old;
		}
		
		suratsurat::find($id)->update([
		'no_surat' => $request->no_surat,
		'perihal' => $request->perihal,
		'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
		'lokasi' => $request->arsip,
		'file' => $file,
		]);
		return redirect()->route('suratsurat.index')->with('success','Berhasil di Simpan');
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
		suratsurat::find($id)->delete();
		unlink(public_path('suratsurat1/'.request()->file));
		return redirect()->route('suratsurat.index')->with('hapus','Berhasil delete');
    }
	
	 public function lihatsuratsurat(Request $request)
    {
        //
		$id_suratsurat=$request->id_suratsurat;
		return view('layout.lihat_suratsurat',compact('id_suratsurat'));
		
    }
	 
	 public function surat_masuk()
    {
        //
		$suratsurat=suratsurat::Where('jenis_surat','Surat Masuk')->get();
		return view('layout.suratsurat',compact('suratsurat'));
    }
	
	 public function surat_keluar()
    {
        //
		$suratsurat=suratsurat::Where('jenis_surat','Surat keluar')->get();
		return view('layout.suratsurat',compact('suratsurat'));
    }
	
	public function dokumen_pekerjaan_surat()
    {
        //
		$dlp=DB::table('dokumen_laporan_pekerjaan')->groupBy('no_surat')->get();
		return view('layout.suratsurat',compact('dlp'));
    }
}
