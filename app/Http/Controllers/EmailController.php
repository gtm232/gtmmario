<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
{
	$ke=DB::table('users')->get();
	
	foreach($ke as $ke){
		$no=0;
		$ke2=DB::table('laporan_pekerjaan')->where('pic',$ke->id)->get();
			foreach($ke2 as $ke2){
			    $spk=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$ke2->id],['jenis_dokumen','SPK']])->get()->first();
                $tanggal_awal=date('Y-m-d',strtotime($spk->tanggal));
                $tanggal_berakhir = date('Y-m-d', strtotime('+'.($spk->durasi-1).' days', strtotime($tanggal_awal)));
                $tanggal_akhir=	strtotime($tanggal_berakhir);
				$sekarang    = time(); // Waktu sekarang
				$diff   = $sekarang - $tanggal_akhir;
				//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24 * 365)) . ' Tahun'; // Umur anda dalam hitungan tahun
				//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24)) . ' Hari'; // Umur anda dalam hitungan hari	
				$selisih= floor($diff / (60 * 60 * 24));
				$user=DB::table('users')->where('id','=',$ke2->pic)->get()->first();
					if($ke2->status == "Perintah Untuk Melaksanakan Pekerjaan"){ 
						if($selisih >= -15 or $selisih > 1 ){
							$no++;
							
							}
						}
			
			}
			
			if($no != 0){
				try{  
				Mail::send('email.email', ['pic' => $user->id, 'pesan' => 'seminggu'], function ($message) use ($user)
					{
						$r=$user->email;
						$message->subject('Peringatan');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r);
					});
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
			}
	
	}
	
	//https://mragus.com/mengirim-email-menggunakan-framework-laravel/
	
}

public function sendEmailsetiaphari(Request $request)
{
	$ke=DB::table('users')->get();
	
	foreach($ke as $ke){
		$no=0;
		$ke2=DB::table('laporan_pekerjaan')->where('pic',$ke->id)->get();
			foreach($ke2 as $ke2){
				$tanggal_berakhir  = strtotime($ke2->tanggal_berakhir);
				$sekarang    = time(); // Waktu sekarang
				$diff   = $sekarang - $tanggal_berakhir;
				//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24 * 365)) . ' Tahun'; // Umur anda dalam hitungan tahun
				//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24)) . ' Hari'; // Umur anda dalam hitungan hari	
				$selisih= floor($diff / (60 * 60 * 24));
				$user=DB::table('users')->where('id','=',$ke2->pic)->get()->first();
				$bast=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$ke2->id],['jenis_dokumen','BAST']])->get()->count();
					if($ke2->status != "CLOSED" and $bast == 0){ 
						if($selisih == 0 and $selisih == -10 ){
							$no++;
							
							}
						}
			
			}
			
			if($no != 0){
				try{  
				Mail::send('email.email', ['pic' => $user->id, 'pesan' => 'setiap hari'], function ($message) use ($user)
					{
						$r=$user->email;
						$message->subject('Peringatan');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r);
					});
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
			}
	
	}
	
	//https://mragus.com/mengirim-email-menggunakan-framework-laravel/
	
}

public function print_dokumen(Request $request) 
    {
		//$id_pembuatan_surat=$request->id_pembuatan_surat;
		$id_pembuatan_surat=$request->id;
		return view('print',compact('id_pembuatan_surat'));
		
    }
	
public function print_doc(Request $request) 
    {
		//$id_pembuatan_surat=$request->id_pembuatan_surat;
		$id_pembuatan_surat=$request->id;
		return view('print_doc',compact('id_pembuatan_surat'));
		
    }
}
