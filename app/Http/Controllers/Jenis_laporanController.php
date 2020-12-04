<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class Jenis_laporanController extends Controller
{
    //
	public function jenis_laporan(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		return view('layout.jenis_laporan',compact('id_laporan_bulanan','id_wilayah_operasi'));
		
    }
	
	public function form_edit(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		$id=$request->id;
		return view('edit.jenis_laporan',compact('id_laporan_bulanan','id','id_wilayah_operasi'));
		
	}
	
	public function form_tambah(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		return view('input.jenis_laporan',compact('id_laporan_bulanan','id_wilayah_operasi'));
		
	}
	
	public function tambah(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		DB::table('jenis_laporan')->insert([
			'id_laporan_bulanan' => $id_laporan_bulanan,
			'id_wilayah_operasi' => $id_wilayah_operasi,
			'jenis' => $request->jenis_laporan,
			'id_tujuan' => $request->pelapor,
			]);
			
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
		mkdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$request->jenis_laporan));
		mkdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$request->jenis_laporan."/revisi"));
		return view('layout.jenis_laporan',compact('id_laporan_bulanan','id_wilayah_operasi'))->with('success','Blog saved');
		
    }
	
	public function edit(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id_wilayah_operasi=$request->id_wilayah_operasi;
		
		$tahun=DB::table('laporan_bulanan')->where('id',$id_laporan_bulanan)->get()->first();
		if($tahun->bulan == 1){
			$nama_bulan="Januari";
		}else if($tahun->bulan == 2){
			$nama_bulan="Februari";
		}else if($tahun->bulan == 3){
			$nama_bulan="Maret";
		}else if($tahun->bulan == 4){
			$nama_bulan="April";
		}else if($tahun->bulan == 5){
			$nama_bulan="Mei";
		}else if($tahun->bulan == 6){
			$nama_bulan="Juni";
		}else if($tahun->bulan == 7){
			$nama_bulan="Juli";
		}else if($tahun->bulan == 8){
			$nama_bulan="Agustus";
		}else if($tahun->bulan == 9){
			$nama_bulan="September";
		}else if($tahun->bulan == 10){
			$nama_bulan="Oktober";
		}else if($tahun->bulan == 11){
			$nama_bulan="November";
		}else if($tahun->bulan == 12){
			$nama_bulan="Desember";
		}
		$wilayah=DB::table('wilayah_operasi')->where('id',$id_wilayah_operasi)->get()->first();
		$nama=DB::table('jenis_laporan')->where('id_laporan_bulanan',$id_laporan_bulanan)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id)->get()->first();
		rename('public/laporan_bulanan/'.$tahun->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$jenis_laporan->jenis, 'public/laporan_bulanan/'.$tahun->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$request->jenis_laporan);
		
		DB::table('jenis_laporan')->where('id','=',$request->id)->update([
			'jenis' => $request->jenis_laporan,
			'id_tujuan' => $request->pelapor,
			]);
			return view('layout.jenis_laporan',compact('id_laporan_bulanan','id_wilayah_operasi'))->with('success','Blog saved');
		
    }
	
	public function hapus(Request $request)
    {
        //
		$id_laporan_bulanan=$request->id_laporan_bulanan;
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$id_wilayah_operasi)->get()->first();
		$jenis_laporan=DB::table('jenis_laporan')->where('id',$request->id)->get()->first();
		rmdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/revisi'));
		rmdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis.'/editable'));
		rmdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan.'/'.$wilayah->wilayah_operasi.'/'.$jenis_laporan->jenis));
		DB::table('jenis_laporan')->where('id', '=', $request->id)->delete();
		
		return view('layout.jenis_laporan',compact('id_laporan_bulanan','id_wilayah_operasi'));
    }
	
	public function selesai_melapor(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		
		DB::table('notif_pelaporan')->insert([
			'id_users' => 1,
			'id_laporan_bulanan' => $id_laporan_bulanan,
			]);
			
		DB::table('jenis_laporan')->where('id_tujuan','=',$request->id_tujuan)->update([
			'id_tujuan' => 0,
			]);
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
    }
	
	public function kirim_notif_ke_pelapor(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		DB::table('notif_pelaporan')->insert([
			'id_users' => $request->id_users,
			'id_laporan_bulanan' => $id_laporan_bulanan,
			]);
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
	}
	
}
