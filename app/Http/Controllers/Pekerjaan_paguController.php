<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\pekerjaan_pagu;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\URL;

class Pekerjaan_paguController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('layout.pekerjaan_pagu');
    }
	
	public function pekerjaan_cari_pagu(Request $request)
    {
        //
		$cari=$request->cari;
		$tahundashboard=$request->tahundashboard;
		return view('layout.pekerjaan_pagu',compact('cari','tahundashboard'));
    }
	
	 public function pac_pagu(Request $request)
    {
        //
		$pekerjaanaccrue=1; 
		$tahundashboard=$request->tahundashboard;
		return view('layout.pekerjaan_pagu',compact('pekerjaanaccrue','tahundashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.pekerjaan_pagu');
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
			'status' => '',
			'wilayah_operasi' => $request->wilayah_operasi,
			'tahun' => $request->tahun,
			  );
		$id_laporan_pekerjaan=DB::table('laporan_pekerjaan_pagu')->insertGetId($data);
		if(!is_dir(public_path("laporan_pekerjaan_pagu/".$request->tahun))){
		mkdir(public_path("laporan_pekerjaan_pagu/".$request->tahun));
		}
		mkdir(public_path("laporan_pekerjaan_pagu/".$request->tahun."/".$request->nama_pekerjaan));
		
		return redirect()->route('pekerjaan_pagu.index')->with('success','Berhasil di Simpan');
		
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
    public function edit(pekerjaan_pagu $pekerjaan_pagu)
    {
        //
		return view('edit.pekerjaan_pagu',compact('pekerjaan_pagu',$pekerjaan_pagu));
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
		
		pekerjaan_pagu::find($id)->update([
		'nama_pekerjaan' => $request->nama_pekerjaan,
			'lokasi' => $request->lokasi,
			'pic' => $request->pic,
			'wilayah_operasi' => $request->wilayah_operasi,
			'jenis_pekerjaan' => $request->jenis_pekerjaan,
			'tahun' => $request->tahun,
		]);
		
		rename('public/laporan_pekerjaan_pagu/'.$request->tahun_old."/".$request->nama_pekerjaan_old, 'public/laporan_pekerjaan_pagu/'.$request->tahun."/".$request->nama_pekerjaan);
		
		return redirect()->route('pekerjaan_pagu.index')->with('success','Berhasil di Simpan');
		
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
		$pekerjaan_pagu=pekerjaan_pagu::where('id','=',$id)->get()->first();
		$dokumen_laporan_pekerjaan_pagu=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id_laporan_pekerjaan',$pekerjaan_pagu->id)->get();
		$dokumen_laporan_pekerjaan_pagu2=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id_laporan_pekerjaan',$pekerjaan_pagu->id)->count();
		
		$files    =glob(public_path('laporan_pekerjaan_pagu/'.$pekerjaan_pagu->tahun.'/'.$pekerjaan_pagu->nama_pekerjaan.'/*'));
		foreach ($files as $file) {
		if (is_file($file))
		unlink($file); // hapus file
		}
		rmdir(public_path("laporan_pekerjaan_pagu/".$pekerjaan_pagu->tahun."/".$pekerjaan_pagu->nama_pekerjaan));
		$spk_dev_pagu=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id],['jenis_dokumen','SPK']])->get()->first();
		$spk_dev_pagu_jml=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id],['jenis_dokumen','SPK']])->count();
		if($spk_dev_pagu_jml != 0){
		$hapus_popay_pagu=DB::table('spk_dev_pagu')->where('id_dokumen', '=', $spk_dev_pagu->id)->get();
		foreach($hapus_popay_pagu as $hapus_popay_pagu){
		DB::table('popay_pagu')->where('id_spk_dev', '=', $hapus_popay_pagu->id)->delete();
		}
		DB::table('spk_dev_pagu')->where('id_dokumen', '=', $spk_dev_pagu->id)->delete();
		}
		pekerjaan_pagu::find($id)->delete();
		DB::table('dokumen_laporan_pekerjaan_pagu')->where('id_laporan_pekerjaan', '=', $id)->delete();
		return redirect()->route('pekerjaan_pagu.index')->with('hapus','Berhasil delete');
    }
	
	public function hanya_saya_pagu()
    {
        //
		$pekerjaan_pagu=pekerjaan_pagu::all();
		$hanya_saya_pagu=1;
		return view('layout.pekerjaan',compact('pekerjaan_pagu'),compact('hanya_saya_pagu'));
    }
	public function carifile_pagu(Request $request)
    {
        //
		$pekerjaan_pagu=pekerjaan_pagu::all();
		$carifile_pagu=$request->jenisdokumen;
		return view('layout.pekerjaan_pagu',compact('pekerjaan_pagu'),compact('carifile_pagu'));
    }
}
