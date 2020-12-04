<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Bulanan;

use PDF;

use Zipper;

class BulananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$tahunbulan=date('Y');
		$bulanan=bulanan::where('tahun',$tahunbulan)->orderBy('bulan','Asc')->get();
		
		$files    =glob('public/laporan_bulanan/download/*');
		foreach ($files as $file) {
			if (is_file($file))
			unlink($file); // hapus file
		}
		
		return view('layout.bulanan',compact('bulanan','tahunbulan'));
    }
	
	 public function bulan_tahun(Request $request)
    {
        //
		$tahunbulan=$request->tahunbulan;
		$bulanan=bulanan::where('tahun',$tahunbulan)->orderBy('bulan','Asc')->get();
		return view('layout.bulanan',compact('bulanan','tahunbulan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.bulanan');
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
		$parameter=DB::table('laporan_bulanan')->where([['tahun',$request->tahun],['bulan',$request->bulan],])->count();
		if($parameter == 0){
		bulanan::create([
		'bulan' => $request->bulan,
		'tahun' => $request->tahun,
		'arsip' => $request->arsip,
		]);
		
		if($request->bulan == 1){
			$nama_bulan="Januari";
		}else if($request->bulan == 2){
			$nama_bulan="Februari";
		}else if($request->bulan == 3){
			$nama_bulan="Maret";
		}else if($request->bulan == 4){
			$nama_bulan="April";
		}else if($request->bulan == 5){
			$nama_bulan="Mei";
		}else if($request->bulan == 6){
			$nama_bulan="Juni";
		}else if($request->bulan == 7){
			$nama_bulan="Juli";
		}else if($request->bulan == 8){
			$nama_bulan="Agustus";
		}else if($request->bulan == 9){
			$nama_bulan="September";
		}else if($request->bulan == 10){
			$nama_bulan="Oktober";
		}else if($request->bulan == 11){
			$nama_bulan="November";
		}else if($request->bulan == 12){
			$nama_bulan="Desember";
		}
		if(!is_dir(public_path("laporan_bulanan/".$request->tahun))){
		mkdir(public_path("laporan_bulanan/".$request->tahun));
		}
		mkdir(public_path("laporan_bulanan/".$request->tahun."/".$nama_bulan));
		}
		return redirect()->route('bulanan.index')->with('success','Berhasil di Simpan');
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
    public function edit(bulanan $bulanan)
    {
        //
		return view('edit.bulanan',compact('bulanan',$bulanan));
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
		$bulanan=DB::table('laporan_bulanan')->where('id',$id)->get()->first();
			if($bulanan->bulan == 1){
				$nama_bulan="Januari";
			}else if($bulanan->bulan == 2){
				$nama_bulan="Februari";
			}else if($bulanan->bulan == 3){
				$nama_bulan="Maret";
			}else if($bulanan->bulan == 4){
				$nama_bulan="April";
			}else if($bulanan->bulan == 5){
				$nama_bulan="Mei";
			}else if($bulanan->bulan == 6){
				$nama_bulan="Juni";
			}else if($bulanan->bulan == 7){
				$nama_bulan="Juli";
			}else if($bulanan->bulan == 8){
				$nama_bulan="Agustus";
			}else if($bulanan->bulan == 9){
				$nama_bulan="September";
			}else if($bulanan->bulan == 10){
				$nama_bulan="Oktober";
			}else if($bulanan->bulan == 11){
				$nama_bulan="November";
			}else if($bulanan->bulan == 12){
				$nama_bulan="Desember";
			}
			
			if($request->bulan == 1){
				$nama_bulan2="Januari";
			}else if($request->bulan == 2){
				$nama_bulan2="Februari";
			}else if($request->bulan == 3){
				$nama_bulan2="Maret";
			}else if($request->bulan == 4){
				$nama_bulan2="April";
			}else if($request->bulan == 5){
				$nama_bulan2="Mei";
			}else if($request->bulan == 6){
				$nama_bulan2="Juni";
			}else if($request->bulan == 7){
				$nama_bulan2="Juli";
			}else if($request->bulan == 8){
				$nama_bulan2="Agustus";
			}else if($request->bulan == 9){
				$nama_bulan2="September";
			}else if($request->bulan == 10){
				$nama_bulan2="Oktober";
			}else if($request->bulan == 11){
				$nama_bulan2="November";
			}else if($request->bulan == 12){
				$nama_bulan2="Desember";
			}

		rename('public/laporan_bulanan/'.$bulanan->tahun.'/'.$nama_bulan,'public/laporan_bulanan/'.$bulanan->tahun.'/'.$nama_bulan2);
		bulanan::find($id)->update([
		'bulan' => $request->bulan,
		'tahun' => $request->tahun,
		'arsip' => $request->arsip,
		]);
		return redirect()->route('bulanan.index')->with('success','Berhasil di Simpan');
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
		$folder=DB::table('laporan_bulanan')->where('id',$id)->get()->first();
		if($folder->bulan == 1){
			$nama_bulan="Januari";
		}else if($folder->bulan == 2){
			$nama_bulan="Februari";
		}else if($folder->bulan == 3){
			$nama_bulan="Maret";
		}else if($folder->bulan == 4){
			$nama_bulan="April";
		}else if($folder->bulan == 5){
			$nama_bulan="Mei";
		}else if($folder->bulan == 6){
			$nama_bulan="Juni";
		}else if($folder->bulan == 7){
			$nama_bulan="Juli";
		}else if($folder->bulan == 8){
			$nama_bulan="Agustus";
		}else if($folder->bulan == 9){
			$nama_bulan="September";
		}else if($folder->bulan == 10){
			$nama_bulan="Oktober";
		}else if($folder->bulan == 11){
			$nama_bulan="November";
		}else if($folder->bulan == 12){
			$nama_bulan="Desember";
		}
		
		rmdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan));
		bulanan::find($id)->delete();
		return redirect()->route('bulanan.index')->with('hapus','Berhasil delete');
    }
	
	public function fzip(Request $request)
    {
        //
		$tahun_bulan=DB::table('laporan_bulanan')->where('id',$request->id_bulanan)->get()->first();
		if($tahun_bulan->bulan == 1){
			$nama_bulan="Januari";
		}else if($tahun_bulan->bulan == 2){
			$nama_bulan="Februari";
		}else if($tahun_bulan->bulan == 3){
			$nama_bulan="Maret";
		}else if($tahun_bulan->bulan == 4){
			$nama_bulan="April";
		}else if($tahun_bulan->bulan == 5){
			$nama_bulan="Mei";
		}else if($tahun_bulan->bulan == 6){
			$nama_bulan="Juni";
		}else if($tahun_bulan->bulan == 7){
			$nama_bulan="Juli";
		}else if($tahun_bulan->bulan == 8){
			$nama_bulan="Agustus";
		}else if($tahun_bulan->bulan == 9){
			$nama_bulan="September";
		}else if($tahun_bulan->bulan == 10){
			$nama_bulan="Oktober";
		}else if($tahun_bulan->bulan == 11){
			$nama_bulan="November";
		}else if($tahun_bulan->bulan == 12){
			$nama_bulan="Desember";
		}
		$param=DB::table('dokumen_laporan_bulanan')->where('id_laporan_bulanan',$request->id_bulanan)->count();
		if($param != 0){
		$files = glob(public_path('laporan_bulanan/'.$tahun_bulan->tahun.'/'.$nama_bulan));
			Zipper::make(public_path('laporan_bulanan/download/'.$nama_bulan.'.zip'))->add($files)->close();
			return response()->download(public_path('laporan_bulanan/download/'.$nama_bulan.'.zip'));
			
		}
		$files    =glob('public/laporan_bulanan/download/*');
		foreach ($files as $file) {
			if (is_file($file))
			unlink($file); // hapus file
		}
		return redirect()->route('bulanan.index')->with('success','Berhasil di Simpan');
		
    }
	
	public function tanda_terima(Request $request)
    {
		$id_laporan_bulanan=$request->id_bulanan;
  
    	$pdf = PDF::loadview('tanda_terima',['id_laporan_bulanan'=>$id_laporan_bulanan]);
    	return $pdf->stream();
		//return $pdf->download('tanda_terima.pdf');
	}
	
}
