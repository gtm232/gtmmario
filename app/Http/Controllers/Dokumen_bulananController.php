<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';


class Dokumen_bulananController extends Controller
{
	
	public function dokumen_bulanan(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		return view('layout.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi'));
		
    }
	
	public function form_tambah(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		return view('input.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi'));
		
	}
	
	public function tambah(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		if($request->prihal != null and $request->file != null){
		
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_dokumen_laporann	="(".$acak.") ".request()->file->getClientOriginalName();
		$nama_dokumen_laporan	=preg_replace("/[^a-zA-Z0-9 .\-]/", "", $nama_dokumen_laporann);
		request()->file->move(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis),$nama_dokumen_laporan);
		}else{ 
		$nama_dokumen_laporan="";
		}
		
		$data = array(
			'prihal' => $request->prihal,
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'nama_dokumen_laporan' => $nama_dokumen_laporan,
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'jenis_laporan' => $request->id_jenis_laporan,
			'wilayah_operasi' => $request->id_wilayah_operasi,
		);
		$id_dokumen_bulanan=DB::table('dokumen_laporan_bulanan')->insertGetId($data);
		DB::table('notif_catatan_revisi')->insert([
			'id_jenis_laporan' => $request->id_jenis_laporan,
			'id_dokumen_laporan' => $id_dokumen_bulanan,
			'status' => 'Melaporkan',
			]);
		
		DB::table('history_laporan_bulanan')->insert([
			'jenis_laporan' => $request->id_jenis_laporan,
			'id_dokumen_bulanan' => $id_dokumen_bulanan,
			'keterangan' => 'Melaporkan',
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'id_users' => $request->id_users,
			]);
		}	//return view('layout.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi'))->with('success','Blog saved');
		
		echo "
		<form id='back_dbln' action='".url('/dokumen_bulanan')."' method='post'>
						<input type='hidden' name='_token' value='".csrf_token()."'>
						<input type='hidden' name='id_laporan_bulanan' value='".$id_laporan_bulanan."'>
						<input type='hidden' name='id_jenis_laporan' value='".$id_jenis_laporan."'>
						<input type='hidden' name='id_wilayah_operasi' value='".$id_wilayah_operasi."'>
						<button style='display:none;' type='submit' class='btn btn-primary'>save</button></a>
	</form>
		";
		
		echo "<script>document.getElementById('back_dbln').submit();</script>";
		
    }
	
	public function form_edit(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		return view('edit.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'));
		
	}
	
	public function edit(Request $request){
		
		if(request()->file != null){
		
		}else{
		
		}
		
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_dokumen_laporann	="(".$acak.") ".request()->file->getClientOriginalName();
		$nama_dokumen_laporan	=preg_replace("/[^a-zA-Z0-9 .\-]/", "", $nama_dokumen_laporann);
		request()->file->move(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis),$nama_dokumen_laporan);
		unlink(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/'.request()->file_old));
		}else{ 
		$nama_dokumen_laporan=$request->file_old;
		}
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		DB::table('dokumen_laporan_bulanan')->where('id','=',$request->id)->update([
			'prihal' => $request->prihal,
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'nama_dokumen_laporan' => $nama_dokumen_laporan,
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'jenis_laporan' => $request->id_jenis_laporan,
			'wilayah_operasi' => $request->id_wilayah_operasi,
			]);
		
		$param_edit_notif=DB::table('notif_catatan_revisi')->where([['id_jenis_laporan',$request->id_jenis_laporan],['id_dokumen_laporan',$request->id],])->get()->first();
		if($param_edit_notif->status == "Revisi"){
		DB::table('notif_catatan_revisi')->where([['id_jenis_laporan',$request->id_jenis_laporan],['id_dokumen_laporan',$request->id],])->update([
			'status' => 'Melaporkan',
			]);
		}
			return view('layout.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi'))->with('success','Blog saved');
	}
	
	public function hapus(Request $request)
    {
        //
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		
		DB::table('dokumen_laporan_bulanan')->where('id', '=', $request->id)->delete();
		unlink(public_path('laporan_bulanan/'.'/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/'.request()->nama_dokumen_laporan));
		
		return view('layout.dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi'))->with('success','Blog saved');
    }
	
	public function lihat_dokumen_bulanan(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		return view('layout.lihat_dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'));
		
    }
	
	public function lihat_dokumen_bulanan2(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		$halaman=$request->halaman;
		return view('layout.lihat_dokumen_bulanan2',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id','halaman'));
		
    }
	
	public function form_tambah_attach(Request $request){
		$id=$request->id;
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		return view('input.attach',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'));
		
	}
	
	public function tambah_attach(Request $request)
    {
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
		$jl=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$wil=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
	
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
		$acak = rand(10000, 99999);
		
		if(!is_dir(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wil->wilayah_operasi.'/'.$jl->jenis.'/editable'))){
		mkdir(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wil->wilayah_operasi.'/'.$jl->jenis.'/editable'));
		}
		if(request()->file != null){
		$nama_dokumen_laporan	="(".$acak.") ".request()->file->getClientOriginalName();
		request()->file->move(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wil->wilayah_operasi.'/'.$jl->jenis.'/editable'),$nama_dokumen_laporan);
		}else{
		$nama_dokumen_laporan="";
		}
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		DB::table('attach')->insert([
			'nama_dokumen' => $nama_dokumen_laporan,
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'id_jenis_laporan' => $request->id_jenis_laporan,
			'id_wilayah_operasi' => $request->id_wilayah_operasi,
			]);
			return view('layout.lihat_dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'))->with('success','Blog saved');
		
    }
	
	public function hapus_attach(Request $request)
    {
        //
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
		$jl=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$wo=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
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
		$id=$request->id;
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		DB::table('attach')->where('id', '=', $request->id_attach)->delete();
		unlink(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wo->wilayah_operasi.'/'.$jl->jenis.'/editable/'.addslashes(request()->nama_dokumen)));
		
		return view('layout.lihat_dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'))->with('success','Blog saved');
    }
	
	public function catatan(Request $request)
    {
        //
		echo "<div style='text-align:center; color:blue; opacity:0.8; margin: 0 auto; display: block; width:100px;' id='draggable".$request->no."' class='ui-widget-content'>
		  ".$request->isi."
		</div>

		<script>
		  $( function() {
			$( '#draggable".$request->no."' ).draggable();
		  } );
		  $( function() {
			$( '#draggable".$request->no."' ).resizable();
		  } );
		</script> ";
	}
	
	public function garis(Request $request)
    {
        //
		echo "<div style='opacity:0.7; height:40px; background:red; margin: 0 auto; display: block; width:40px;' id='garis".$request->no_garis."' class='ui-widget-content'>
		  
		</div>

		<script>
		  $( function() {
			$( '#garis".$request->no_garis."' ).draggable();
		  } );
		  $( function() {
			$( '#garis".$request->no_garis."' ).resizable();
		  } );
		</script> ";
	}
	
	public function save_revisi_data(Request $request)
	{
		$param=DB::table('laporan_bulanan_revisi')->where([['id_dokumen_laporan_bulanan',$request->id_dokumen_laporan_bulanan],['user',$request->user], ['halaman',$request->halaman],])->count();
		if($param == 0){
		DB::table('laporan_bulanan_revisi')->insert([
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'id_dokumen_laporan_bulanan' => $request->id_dokumen_laporan_bulanan,
			'user' => $request->user,
			'nama_gambar' => $request->nama_gambar,
			'halaman' => $request->halaman,
			'input' => $request->input,
			]);
			echo "ok";
		}else{
			echo "Halaman Ini Sudah ada di daftar, Jika ingin menggantinya silahkan hapus dulu";
		}
		
	}
	
	public function save_revisi(Request $request)
    {
		if($request->param == "ok"){
			
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		$user=$request->id_user;
		
		$base = str_replace(" ","",$request->file);
		$base64_pdf1 = strpos($base,","); 
		$base64_pdf	= substr($base,($base64_pdf1+1));
		$base64_decode = base64_decode($base64_pdf);
	   
	  
		
		$folder=DB::table('laporan_bulanan')->where('id',$id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$id_jenis_laporan)->get()->first();
		
	   
	    $pdf = fopen(public_path('laporan_bulanan/'.'/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/revisi/'.$request->nama_gambar), 'w');
	    fwrite($pdf, $base64_decode);
		
		}
		
		echo "<script>javascript:self.close();</script>";
	    
		//return view('layout.lihat_dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'));
		
	    
		
	}
	
	public function lihat_revisi()
	{
		return view('layout.lihat_revisi');
	}
	
	public function hapus_revisi(Request $request)
	{
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		$input=$request->input;
		
		$hapus_semua=DB::table('laporan_bulanan_revisi')->where([['id_dokumen_laporan_bulanan',$id],['user',$request->user],])->get();
		
		foreach($hapus_semua as $hapus_semua){
			
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		
		unlink(public_path('laporan_bulanan/'.'/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/revisi/'.$hapus_semua->nama_gambar));
		DB::table('laporan_bulanan_revisi')->where('id', '=', $hapus_semua->id)->delete();
		
		}
		//return view('layout.lihat_dokumen_bulanan',compact('id_laporan_bulanan','id_jenis_laporan','id_wilayah_operasi','id'));
	}
	
	public function lihat_hapus_revisi(Request $request)
	{
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$revisi=DB::table('laporan_bulanan_revisi')->where('id',$request->id_revisi)->get()->first();
		
		unlink(public_path('laporan_bulanan/'.'/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/revisi/'.$revisi->nama_gambar));
		DB::table('laporan_bulanan_revisi')->where('id', '=', $request->id_revisi)->delete();
		
		echo "<script>javascript:self.close();</script>";
		
		
	}
	
	public function tampil_revisi_tabel(Request $request){
		
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_jenis_laporan=$request->id_jenis_laporan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		
		$revisi=DB::table('laporan_bulanan_revisi')->where('id_dokumen_laporan_bulanan',$id) ->groupBy('user')->get();
		$folder=DB::table('laporan_bulanan')->where('id',$id_laporan_bulanan)->get()->first();
		$wilayah=DB::table('wilayah_operasi')->where('id',$id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$id_jenis_laporan)->get()->first();
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
		$revisi_no=1;
		
		foreach($revisi as $revisi){
																  
		$user_revisi=DB::table('users')->where('id',$revisi->user)->get()->first();
		$hm=DB::table('users')->where('id',$request->user)->get()->first();
		
		echo "		
			<tr>
				<td>".$user_revisi->name."</td>
				<td>
					<a href='javascript:' onclick='newtab(".$revisi->id.",".$revisi->user.");'>
						<i class='material-icons'>description</i>
					</a>
				</td>
				<td>";
			
		if($revisi->user == $request->user or $hm->hak_akses == "admin"){
				
		
		echo	"<form style='display:none;'  method='post'>
						<input type='hidden' id='token_hapus_revisi' name='_token' value='".csrf_token()."'>
						<input type='hidden' name='id_laporan_bulanan' value='".$id_laporan_bulanan."'>
						<input type='hidden' name='id_jenis_laporan' value='".$id_jenis_laporan."'>
						<input type='hidden' name='id_wilayah_operasi' value='".$id_wilayah_operasi."'>
						<input type='hidden' name='id' value='".$id."'>
						<input type='hidden' id='revisi_id' name='id_revisi' value='".$revisi->id."'>
						<input type='submit' id='hapus_revisi_all' class='btn btn-danger' value='Delete' />
				</form> 
						<a href='javascript:' onclick='hapus_revisi_pdf();'>
						<i class='material-icons'>delete</i>
						</a>
				
				";
		}
				
		echo	"</td>
																			
				
			</tr>";
																	
		$revisi_no++;
																	
		}
	}
	
	public function tambah_revisi_hard(Request $request)
	{
		$folder=DB::table('laporan_bulanan')->where('id',$request->id_laporan_bulanan)->get()->first();
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id_jenis_laporan)->get()->first();
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_dokumen_laporann	="(".$acak.") ".request()->file->getClientOriginalName();
		$nama_dokumen_laporan	=preg_replace("/[^a-zA-Z0-9 .\-]/", "", $nama_dokumen_laporann);
		request()->file->move(public_path('laporan_bulanan/'.$folder->tahun.'/'.$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/revisi'),$nama_dokumen_laporan);
		}else{ 
		$nama_dokumen_laporan="";
		}
		DB::table('laporan_bulanan_revisi')->insert([
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'id_dokumen_laporan_bulanan' => $request->id,
			'user' => $request->id_user,
			'nama_gambar' => $nama_dokumen_laporan,
			'halaman' => 0,
			'input' => $request->input,
			]);
		echo "<script>javascript:self.close();</script>";
	}
	
	function pilih_user_review(Request $request){
		
		DB::table('user_review_catatan_revisisi')->insert([
			'id_notif_catatan_review' => $request->id_notif_catatan_review,
			'user_review' => $request->user_review,
			]);
		
		
		echo "<script>javascript:self.close();</script>";
		
	}
	
	function selesai_review(Request $request){
		
		DB::table('user_review_catatan_revisisi')->where([['id_notif_catatan_review', '=', $request->id_notif_catatan_review],['user_review',$request->user_review],])->delete();
		
		$rb=DB::table('user_review_catatan_revisisi')->where('id_notif_catatan_review', '=', $request->id_notif_catatan_review)->count();
		
		if($rb == 0){
		$rc=DB::table('laporan_bulanan_revisi')->where('id_dokumen_laporan_bulanan',$request->id_dokumen_laporan_bulanan)->count();
		if($rc == 0){
			$status="Ok";
		}else{
			$status="Revisi";
		}
			DB::table('notif_catatan_revisi')->where('id','=',$request->id_notif_catatan_review)->update([
			'Status' => $status,
			]);
			
			$rd=DB::table('dokumen_laporan_bulanan')->where('id',$request->id_dokumen_laporan_bulanan)->get()->first();
			$id_laporan_bulanan=$request->id_laporan_bulanan;
			DB::table('notif_pelaporan')->insert([
			'id_users' => 1,
			'id_laporan_bulanan' => $rd->id_laporan_bulanan,
			]);
			
			$hs=DB::table('notif_catatan_revisi')->where('id','=',$request->id_notif_catatan_review)->get()->first();
			DB::table('history_laporan_bulanan')->insert([
			'jenis_laporan' => $hs->id_jenis_laporan,
			'id_dokumen_bulanan' => $hs->id_dokumen_laporan,
			'keterangan' => $status,
			'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
			'id_users' => $request->id_user,
			]);
			
		}
	
		echo "<script>javascript:self.close();</script>";
		
	}
	
	function statustandaterima(Request $request){
		
		DB::table('notif_catatan_revisi')->where([['id_jenis_laporan',$request->id_jenis_laporan],['id_dokumen_laporan',$request->id],])->update([
			'status' => $request->text,
			]);
	
		echo "
		<form id='back_dbln' action='".url('/dokumen_bulanan')."' method='post'>
						<input type='hidden' name='_token' value='".csrf_token()."'>
						<input type='hidden' name='id_laporan_bulanan' value='".$request->id_laporan_bulanan."'>
						<input type='hidden' name='id_jenis_laporan' value='".$request->id_jenis_laporan."'>
						<input type='hidden' name='id_wilayah_operasi' value='".$request->id_wilayah_operasi."'>
						<button style='display:none;' type='submit' class='btn btn-primary'>save</button></a>
	</form>
		";
		
		echo "<script>document.getElementById('back_dbln').submit();</script>";
		
	}
 
}
