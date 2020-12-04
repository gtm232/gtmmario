<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class Wilayah_operasiController extends Controller
{
    //
	public function wilayah_operasi(Request $request)
    {
		if(isset($request->id_notif)){
			DB::table('notif_pelaporan')->where('id', '=', $request->id_notif)->delete();
		}
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'));
		
    }
	
	public function form_tambah(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		return view('input.wilayah_operasi',compact('id_laporan_bulanan'));
		
	}
	
	public function tambah(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		DB::table('wilayah_operasi')->insert([
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			'wilayah_operasi' => $request->wilayah_operasi,
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
		mkdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan."/".$request->wilayah_operasi));
		
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
		
    }
	
	public function form_edit(Request $request){
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		$id=$request->id;
		return view('edit.wilayah_operasi',compact('id_laporan_bulanan'),compact('id'));
		
	}
	
	public function edit(Request $request)
    {
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		DB::table('wilayah_operasi')->where('id','=',$request->id)->update([
			'wilayah_operasi' => $request->wilayah_operasi,
			]);
			return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
		
    }
	
	public function hapus(Request $request)
    {
        //
		$id_laporan_bulanan=$request->id_laporan_bulanan;
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
		$wilayah=DB::table('wilayah_operasi')->where('id',$request->id)->get()->first();
		rmdir(public_path("laporan_bulanan/".$folder->tahun."/".$nama_bulan.'/'.$wilayah->wilayah_operasi));
		DB::table('wilayah_operasi')->where('id', '=', $request->id)->delete();
		
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
    }
	
	public function kirim_notif_ke_pelapor(Request $request)
    {
        //
		$id_laporan_bulanan=$request->id_laporan_bulanan;
		DB::table('notif_pelaporan')->insert([
			'id_users' => $request->id_users,
			'id_laporan_bulanan' => $request->id_laporan_bulanan,
			]);
		
		return view('layout.wilayah_operasi',compact('id_laporan_bulanan'))->with('success','Blog saved');
    }
	
}
