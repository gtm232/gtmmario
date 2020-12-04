<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pekerjaan;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('layout.pekerjaan');
    }
	
	public function pekerjaan_cari(Request $request)
    {
        //
		$cari=$request->cari;
		$tahundashboard=$request->tahundashboard;
		return view('layout.pekerjaan',compact('cari','tahundashboard'));
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
    public function create()
    {
        //
		return view('input.pekerjaan');
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
            'nama_pekerjaan' => $request->nama_pekerjaan,
			'lokasi' => $request->lokasi,
			'pic' => $request->pic,
			'status' => "",
			'wilayah_operasi' => $request->wilayah_operasi,
			'jenis_pekerjaan' => $request->jenis_pekerjaan,
			'tahun' => $request->tahun,
			  );
		$id_laporan_pekerjaan=DB::table('laporan_pekerjaan')->insertGetId($data);
		if(!is_dir(public_path("laporan_pekerjaan/".$request->tahun))){
		mkdir(public_path("laporan_pekerjaan/".$request->tahun));
		}
		mkdir(public_path("laporan_pekerjaan/".$request->tahun."/".$request->nama_pekerjaan));
		
		return redirect()->route('pekerjaan.index')->with('success','Berhasil di Simpan');
		
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
    public function edit(pekerjaan $pekerjaan)
    {
        //
		return view('edit.pekerjaan',compact('pekerjaan',$pekerjaan));
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
		
		pekerjaan::find($id)->update([
		'nama_pekerjaan' => $request->nama_pekerjaan,
			'lokasi' => $request->lokasi,
			'pic' => $request->pic,
			'wilayah_operasi' => $request->wilayah_operasi,
			'jenis_pekerjaan' => $request->jenis_pekerjaan,
			'tahun' => $request->tahun,
		]);
		
		rename('public/laporan_pekerjaan/'.$request->tahun_old."/".$request->nama_pekerjaan_old, 'public/laporan_pekerjaan/'.$request->tahun."/".$request->nama_pekerjaan);
		
		return redirect()->route('pekerjaan.index')->with('success','Berhasil di Simpan');
		
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
		$pekerjaan=pekerjaan::where('id','=',$id)->get()->first();
		$dokumen_laporan_pekerjaan=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$pekerjaan->id)->get();
		$dokumen_laporan_pekerjaan2=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$pekerjaan->id)->count();
		
		$files    =glob(public_path('laporan_pekerjaan/'.$pekerjaan->tahun.'/'.$pekerjaan->nama_pekerjaan.'/*'));
		foreach ($files as $file) {
		if (is_file($file))
		unlink($file); // hapus file
		}
		rmdir(public_path("laporan_pekerjaan/".$pekerjaan->tahun."/".$pekerjaan->nama_pekerjaan));
		$spk_dev=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id],['jenis_dokumen','SPK']])->get()->first();
		$spk_dev_jml=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id],['jenis_dokumen','SPK']])->count();
		if($spk_dev_jml != 0){
		$hapus_popay=DB::table('spk_dev')->where('id_dokumen', '=', $spk_dev->id)->get();
		foreach($hapus_popay as $hapus_popay){
		DB::table('popay')->where('id_spk_dev', '=', $hapus_popay->id)->delete();
		}
		DB::table('spk_dev')->where('id_dokumen', '=', $spk_dev->id)->delete();
		}
		pekerjaan::find($id)->delete();
		DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan', '=', $id)->delete();
		return redirect()->route('pekerjaan.index')->with('hapus','Berhasil delete');
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
