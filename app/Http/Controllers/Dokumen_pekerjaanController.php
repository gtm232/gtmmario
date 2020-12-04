<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class Dokumen_pekerjaanController extends Controller
{
    //
	public function dokumen_pekerjaan(Request $request)
    {
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		return view('layout.dokumen_pekerjaan',compact('id_laporan_pekerjaan'));
		
    } 
	
	public function form_tambah(Request $request){
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$no_surat=DB::table('pembuatan_surat')->where('id',$request->id)->get()->first();
		if(isset($request->ps)){
		return view('input.dokumen_pekerjaan',compact('id_laporan_pekerjaan','no_surat'));
		}else{
		return view('input.dokumen_pekerjaan',compact('id_laporan_pekerjaan'));	
		}
		
	}
	
	public function tambah(Request $request)
    {
		
		$harga1		= substr($request->harga,3);
		$harga = str_replace(".", "", $harga1);
		
		$acak = rand(10, 99);
		
		$no_urut1=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$request->id_laporan_pekerjaan)->orderBy('no_urut', 'DESC')->get()->first();
		if($no_urut1){
		$no_urut=$no_urut1->no_urut + 1;
		}else{
		$no_urut=1;
		}
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		if($request->jenis_dokumen == "Surat Masuk" or $request->jenis_dokumen == "Surat Keluar"){
			$nama_dokumen=$request->jenis_dokumen."(".$acak.").pdf";
		}else{
			$nama_dokumen=$request->jenis_dokumen."(".$acak.").pdf";
		}
		$nama_pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();
		$dolapan=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->get();
		$dolapans=$nama_pekerjaan->tahun;
		request()->file->move(public_path('laporan_pekerjaan/'.$dolapans.'/'.$nama_pekerjaan->nama_pekerjaan),$nama_dokumen);
		$parm2=DB::table('spk_dev')->where('id',$request->persentasi_pembayaran)->get()->first();
		if($parm2){
			$persentasi_pembayaran=$parm2->persentasi;
		}else{
			$persentasi_pembayaran=0;
		}
		DB::table('dokumen_laporan_pekerjaan')->insert([
			'id_laporan_pekerjaan' => $id_laporan_pekerjaan,
			'no_surat' => $request->no_surat,
			'nama' => $request->nama,
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'jenis_dokumen' => $request->jenis_dokumen,
			'file' => $nama_dokumen,
			'harga' => $harga,
			'durasi' => $request->durasi,
			'nama_folder' => $nama_pekerjaan->nama_pekerjaan,
			'no_urut' => $no_urut,
			'persentasi_pembayaran' => $persentasi_pembayaran,
			'id_spk_dev' => $request->persentasi_pembayaran,
			]);
		
		if($request->jenis_dokumen == "SPPH"){
			$status="Permintaan Penawaran Harga";
		}elseif($request->jenis_dokumen == "Usulan"){
			$status="Penawaran Harga";
		}elseif($request->jenis_dokumen == "SPH"){
			$status="Penawaran Harga";
		}elseif($request->jenis_dokumen == "Undangan Nego"){
			$status="Undangan Untuk Negosiasi";
		}elseif($request->jenis_dokumen == "BA Nego"){
			$status="Berita Acara Atas Negosiasi";
		}elseif($request->jenis_dokumen == "SPK"){
			$status="Perintah Untuk Melaksanakan Pekerjaan";
		}elseif($request->jenis_dokumen == "LPS"){
			$status="Telah Melaporkan Selesainya Pekerjaan";
		}elseif($request->jenis_dokumen == "BAP"){
			$t=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK'],])->get()->first();
			$t2=DB::table('spk_dev')->where('id_dokumen',$t->id)->count();
			if($t2 > 1){
				$t3=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAP'],])->count();
				if($t3 < $t2){
					$status="Perintah Untuk Melaksanakan Pekerjaan";
				}else{
					$status="Pemeriksaan Pekerjaan";
				}
			}else{
				$status="Pemeriksaan Pekerjaan";
			}
			
		}elseif($request->jenis_dokumen == "BAST"){
			$t=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK'],])->get()->first();
			$t2=DB::table('spk_dev')->where('id_dokumen',$t->id)->count();
			if($t2 > 1){
				$t3=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAP'],])->count();
				if($t3 < $t2){
					$status="Perintah Untuk Melaksanakan Pekerjaan";
				}else{
					$status="Serah Terima Pekerjaan";
				}
			}else{
				$status="Serah Terima Pekerjaan";
			}
			
		}elseif($request->jenis_dokumen == "SPP"){
			$status="Sudah Menyampaikan Penagihan";
		}else{
			$status="tidak";
		}
		if($status != "tidak" and $request->status != "tidak"){
		DB::table('laporan_pekerjaan')->where('id','=',$id_laporan_pekerjaan)->update([
			'status' => $status,
			]);
		}	
		if($request->jenis_dokumen == "Surat Masuk" or $request->jenis_dokumen == "Surat Keluar"){
			$doper=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK']])->get()->first();
			$doperjml=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK']])->count();
			
			if($doperjml != 0){
				if($harga != $doper->harga and $harga != 0 and $request->harga != null){
					$harga_perubahan=$harga;
				
				DB::table('dokumen_laporan_pekerjaan')->where('id','=',$doper->id)->update([
				'harga' => $harga_perubahan,
				]);
				}
			}
		}
			return view('layout.dokumen_pekerjaan',compact('id_laporan_pekerjaan'))->with('success','Blog saved');

	}
	
	public function form_edit(Request $request){
	    
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$id=$request->id;
		return view('edit.dokumen_pekerjaan',compact('id_laporan_pekerjaan','id'));
		
	}
	
	public function edit(Request $request){
		$nama_pekerjaan=DB::table('laporan_pekerjaan')->where('id','=', $request->id_laporan_pekerjaan)->get()->first(); 
		
		//if($request->harga == null){
			//$harga=$request->harga;
		//}else{
		$harga1		= substr($request->harga,3);
		$harga = str_replace(".", "", $harga1);
		//}
		
		
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$acak = rand(100, 999); 
		if($request->file != null){
		//$nama_dokumen_laporan=$nama_dokumen_laporan1.". ".$request->jenis_dokumen."(".$acak.").pdf";
		$nama_dokumen=$request->jenis_dokumen."(".$acak.").pdf";
		$dolapan=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->get();
		$dolapans=$nama_pekerjaan->tahun;
		unlink(public_path('laporan_pekerjaan/'.$dolapans.'/'.$nama_pekerjaan->nama_pekerjaan.'/'.$request->file_old));
		request()->file->move(public_path('laporan_pekerjaan/'.$dolapans.'/'.$nama_pekerjaan->nama_pekerjaan),$nama_dokumen);
		
		
		}else{
			
		$nama_dokumen=request()->file_old;
		
		}
		
		$nr=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$request->id_laporan_pekerjaan)->orderBy('no_urut', 'ASC')->get();
		$nr2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$request->id_laporan_pekerjaan],['no_urut',$request->no_urut],])->get()->count();
		$no=1;
		
		foreach($nr as $nr){
			if($request->no_urut < $request->no_urut_old and $request->no_urut_old != 0){
					if($nr->no_urut >= $request->no_urut and $nr->no_urut <= $request->no_urut_old){ 
						DB::table('dokumen_laporan_pekerjaan')->where('id','=',$nr->id)->update([
						'no_urut' => $no+1,
						]);
					}
				$no++;	
			}else if($request->no_urut > $request->no_urut_old and $request->no_urut_old != 0){
					if($nr->no_urut >= $request->no_urut_old and $nr->no_urut <= $request->no_urut){ 
						DB::table('dokumen_laporan_pekerjaan')->where('id','=',$nr->id)->update([
						'no_urut' => $no-1,
						]);
					}
				$no++;	
			}
		}
		$parm2=DB::table('spk_dev')->where('id',$request->persentasi_pembayaran)->get()->first();
		if($parm2){
			$persentasi_pembayaran=$parm2->persentasi;
		}else{
			$persentasi_pembayaran=0;
		}
		
		DB::table('dokumen_laporan_pekerjaan')->where('id','=',$request->id)->update([
			'id_laporan_pekerjaan' => $id_laporan_pekerjaan,
			'no_surat' => $request->no_surat,
			'nama' => $request->nama,
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'jenis_dokumen' => $request->jenis_dokumen,
			'file' => $nama_dokumen,
			'harga' => $harga,
			'durasi' => $request->durasi,
			'nama_folder' => $nama_pekerjaan->nama_pekerjaan,
			'no_urut' => $request->no_urut,
			'persentasi_pembayaran' => $persentasi_pembayaran,
			'id_spk_dev' => $request->persentasi_pembayaran,
			]);
			
			return view('layout.dokumen_pekerjaan',compact('id_laporan_pekerjaan'))->with('success','Blog saved');
		
	}
	 
	public function hapus(Request $request)
    {
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$nama_pekerjaan=DB::table('laporan_pekerjaan')->where('id', '=', $request->id_laporan_pekerjaan)->get()->first();
		DB::table('dokumen_laporan_pekerjaan')->where('id', '=', $request->id)->delete();
		$hapus_popay=DB::table('spk_dev')->where('id_dokumen', '=', $request->id)->get();
		foreach($hapus_popay as $hapus_popay){
		DB::table('popay')->where('id_spk_dev', '=', $hapus_popay->id)->delete();
		}
		DB::table('spk_dev')->where('id_dokumen', '=', $request->id)->delete();
		$dolapans=$nama_pekerjaan->tahun;
		
		if(request()->file != ""){
		unlink(public_path('laporan_pekerjaan/'.$dolapans.'/'.$nama_pekerjaan->nama_pekerjaan.'/'.request()->file));
		}
		
		$tanda=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'DESC')->get()->first();
		$tandajml=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'DESC')->count();
		
		if($tandajml != 0){
			$tandajenisdokumen=$tanda->jenis_dokumen;
		}else{
			$tandajenisdokumen="";
		}
		
		if($tandajenisdokumen == "SPPH"){
			$status="Permintaan Penawaran Harga";
		}elseif($tandajenisdokumen == "Usulan"){
			$status="Penawaran Harga";
		}elseif($tandajenisdokumen == "SPH"){
			$status="Penawaran Harga";
		}elseif($tandajenisdokumen == "Undangan Nego"){
			$status="Undangan Untuk Negosiasi";
		}elseif($tandajenisdokumen == "BA Nego"){
			$status="Berita Acara Atas Negosiasi";
		}elseif($tandajenisdokumen == "SPK"){
			$status="Perintah Untuk Melaksanakan Pekerjaan";
		}elseif($tandajenisdokumen == "LPS"){
			$status="Telah Melaporkan Selesainya Pekerjaan";
		}elseif($tandajenisdokumen == "BAP"){
			$status="Pemerikasaan Pekerjaan";
		}elseif($tandajenisdokumen == "BAST"){
			$status="Serah Terima Pekerjaan";
		}elseif($tandajenisdokumen == "SPP"){
			$status="Sudah Menyampaikan Penagihan";
		}else{
			$status="";
		}
		
		DB::table('laporan_pekerjaan')->where('id','=',$request->id_laporan_pekerjaan)->update([
			'status' => $status,
			]);
		
		return view('layout.dokumen_pekerjaan',compact('id_laporan_pekerjaan'))->with('success','Blog saved');
    }
	
	public function lihat_dokumen_pekerjaan(Request $request)
    {
    
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$id=$request->id;
		return view('layout.lihat_dokumen_pekerjaan',compact('id_laporan_pekerjaan','id'));
		
    }
	
	 function downloadZip(){

       
            $public_dir  = public_path();
            $zipFileName = 'AllDocuments.zip';
            $zip         = new dokumen_pekerjaan;
 
            if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE)
            {
                $zip->addFile(file_path,'file_name');
                $zip->close();
            }
 
            $headers    = array('Content-Type' => 'application/octet-stream');
            $filetopath = $public_dir.'/'.$zipFileName;
 
            if(file_exists($filetopath))
            {
                return response()->download($filetopath,$zipFileName,$headers);
            }
        
        
        return view('zip');
    

    }
	
	function spk_dev(Request $request){
		$id=$request->id;
		return view('layout.spk_dev',compact('id'));

    }
	
	function tambah_spk_dev(Request $request){
		$id=$request->id;
		return view('input.spk_dev',compact('id'));
    }
    
    function tambah_spk_dev_proses(Request $request){
		if($request->manual_presentasi > 0){
			$presentasi=$request->manual_presentasi;
		}else{
			$presentasi=$request->presentasi;
		}
		$id=$request->id;
		$dolap=DB::table('dokumen_laporan_pekerjaan')->where('id',$id)->get()->first();
		$dolap2=DB::table('spk_dev')->where('id_dokumen',$id)->sum('persentasi');
		$hasil_dolap=$dolap2+$presentasi;
		if($hasil_dolap <= 100){
		DB::table('spk_dev')->insert([
			'id_dokumen' => $id,
			'tahun' => $request->tahun,
			'persentasi' => $presentasi,
			'keterangan' => $request->keterangan,
			'jenis_anggaran' => $request->jenis_anggaran,
			]);
		}
		return view('layout.spk_dev',compact('id'));
    }
	
	function spk_dev_delete(Request $request){
		$id=$request->id;
		DB::table('spk_dev')->where('id', '=', $request->id_spk_dev)->delete();
		DB::table('popay')->where('id_spk_dev', '=', $request->id_spk_dev)->delete();
		return view('layout.spk_dev',compact('id'));
    }
	
	function popaylist(Request $request){
		$id_spk_dev=$request->id_spk_dev;
		$harga=$request->harga;
		return view('layout.popay',compact('id_spk_dev','harga'));
    }
	
	function popay(Request $request){
		$id_spk_dev=$request->id_spk_dev;
		$harga=$request->harga;
		return view('input.popay',compact('id_spk_dev','harga'));
    }
	
	function popay_proses(Request $request){
		$id_spk_dev=$request->id_spk_dev;
		$harga1		= substr($request->harga,3);
		$harga = str_replace(".", "", $harga1);
		$k=DB::table('popay')->where('id_spk_dev',$request->id_spk_dev)->count();
		if($k == 0){
		DB::table('popay')->insert([
			'nomor_pr' => $request->nomorpr,
			'id_spk_dev' => $request->id_spk_dev,
			'tanggal_input' => date('Y-m-d',strtotime($request->tanggal_input)),
			'tanggal_paid' => date('Y-m-d',strtotime($request->tgl_input)),
			'rupiah' => $harga,
			'status' => $request->status,
			]);
		}
		
		$id_dokumen=DB::table('spk_dev')->where('id',$request->id_spk_dev)->get()->first();
		$id_laporan_pekerjaan=DB::table('dokumen_laporan_pekerjaan')->where('id',$id_dokumen->id_dokumen)->get()->first();
		DB::table('laporan_pekerjaan')->where('id','=',$id_laporan_pekerjaan->id_laporan_pekerjaan)->update([
			'status' => $request->status,
			]);
		return view('layout.popay',compact('id_spk_dev','harga'));
		}
	
	public function popay_hapus(Request $request)
    {
		$id_spk_dev=$request->id_spk_dev;
		$harga = $request->harga;
		DB::table('popay')->where('id', '=', $request->id)->delete();
		return view('layout.popay',compact('id_spk_dev','harga'));
    }
	
	function popay_paid(Request $request){
		$id=$request->id;
		$id_spk_dev=$request->id_spk_dev;
		$harga=$request->harga;
		return view('edit.popay_paid',compact('id_spk_dev','harga','id'));
    }
	
	function popay_paid_proses(Request $request){
		$id=$request->id;
		$id_dokumen=DB::table('spk_dev')->where('id',$request->id_spk_dev)->get()->first();
		$id_laporan_pekerjaan=DB::table('dokumen_laporan_pekerjaan')->where('id',$id_dokumen->id_dokumen)->get()->first();
		DB::table('laporan_pekerjaan')->where('id','=',$id_laporan_pekerjaan->id_laporan_pekerjaan)->update([
			'status' => 'Paid',
			]);
		DB::table('popay')->where('id','=',$id)->update([
			'tanggal_paid' => date('Y-m-d',strtotime($request->tanggal_paid)),
			'status' => 'Paid',
			]);
		$id_spk_dev=$request->id_spk_dev;
		$harga=$request->harga;
		
		return view('layout.popay',compact('id_spk_dev','harga'));
    }
	
	function email_notification(Request $request){
		
    }
}
