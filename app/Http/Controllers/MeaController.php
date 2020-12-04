<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mea;

use App\Imports\MeaImportCollection;

use Illuminate\Support\Facades\DB;

use Excel;

use Auth;

use Mail;


class MeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		return view('layout.mea');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('input.mea');
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
		$nama_dokumen_laporan	="(".$acak.") ".request()->file_laporan->getClientOriginalName();
		mea::create([
		'tanggal' => date('Y-m-d',strtotime($request->tanggal)),
		'wilayah' => $request->wilayah,
		'lokasi' => $request->lokasi,
		'expired' => date('Y-m-d',strtotime($request->expired)),
		'status' => $request->status,
		'pj1' => $request->pj1,
		'pj2' => $request->pj2,
		'penyusun1' => $request->penyusun1,
		'penyusun2' => $request->penyusun2,
		'file_laporan' => $nama_dokumen_laporan,
		
		
		]);
		request()->file_laporan->move(public_path('mea'),$nama_dokumen_laporan);
		
		return view('layout.mea');
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
		
		$file_mea=DB::table('mea')->where('id',$id)->get()->first();
		if($file_mea->file_laporan != null){
		unlink(public_path('mea/'.$file_mea->file_laporan));
		}
		mea::find($id)->delete();
		return view('layout.mea');
    }
	
	public function detail_mea(Request $request)
    {
        //
		$id_mea=$request->id_mea;
		return view('layout.detail_mea',compact('id_mea'));
    }
	
	public function tambah_detail_mea(Request $request)
    {
        //
		$id_mea=$request->id_mea;
		return view('input.detail_mea',compact('id_mea'));
    }
	
	public function tambah_detail_mea_proses(Request $request)
    {
        //
		$acak = rand(10000, 99999);
		$dokumentasi	="(".$acak.") ".request()->dokumentasi->getClientOriginalName();
		$id_mea=$request->id_mea;
		
		if($request->yes == "yes"){
			$yes="v";
			$no="";
		}else if($request->yes == "no"){
			$yes="";
			$no="v";
		}
		DB::table('detail_mea')->insert([
			'id_mea' => $request->id_mea,
			'klausul' => $request->klausul,
			'temuan' => $request->temuan,
			'dokumentasi' => $dokumentasi,
			'yes' => $yes,
			'no' => $no,
			'rekomendasi_perbaikan' => $request->rekomendasi_perbaikan,
			'pic' => $request->pic,
			'duedate' => date('Y-m-d',strtotime($request->duedate)),
			'status' => $request->status,
			'notifikasi' => 'BBS',
			]);
			
		
		request()->dokumentasi->move(public_path('mea/gambar'),$dokumentasi);		
		return view('layout.detail_mea',compact('id_mea'));
		
    }
	
	public function edit_detail_mea(Request $request)
    {
        //
		$id_mea=$request->id_mea;
		$id_detail_mea=$request->id_detail_mea;
		return view('edit.detail_mea',compact('id_mea','id_detail_mea'));
    }
	
	public function edit_detail_mea_proses(Request $request)
    {
        //
		$acak = rand(10000, 99999);
		if($request->dokumentasi != null){
		$dokumentasi	="(".$acak.") ".request()->dokumentasi->getClientOriginalName();
		}else{
		$dokumentasi	=$request->dokumentasi_old;
		}
		$id_mea=$request->id_mea;
		$id_detail_mea=$request->id_detail_mea;
		
		if($request->yes == "yes"){
			$yes="v";
			$no="";
		}else if($request->yes == "no"){
			$yes="";
			$no="v";
		}
		DB::table('detail_mea')->where('id','=',$id_detail_mea)->update([
			'id_mea' => $request->id_mea,
			'klausul' => $request->klausul,
			'temuan' => $request->temuan,
			'dokumentasi' => $dokumentasi,
			'yes' => $yes,
			'no' => $no,
			'rekomendasi_perbaikan' => $request->rekomendasi_perbaikan,
			'pic' => $request->pic,
			'duedate' => date('Y-m-d',strtotime($request->duedate)),
			'status' => $request->status,
			]);
		
		if($request->dokumentasi != null){
		request()->dokumentasi->move(public_path('mea/gambar'),$dokumentasi);
		if($request->dokumentasi_old != null){
		unlink(public_path('detail_mea/'.$request->dokumentasi_old));
		}
		}		
		return view('layout.detail_mea',compact('id_mea'));
		
    }
	
	public function hapus_detail_mea(Request $request)
    {
        //
		
		$id_mea=$request->id_mea;
		$m=DB::table('detail_mea')->where('id', $request->id)->get()->first();
		if($m->dokumentasi != null){
		unlink(public_path('mea/gambar/'.$m->dokumentasi));
		}
		
		DB::table('detail_mea')->where('id', '=', $request->id)->delete();
		return view('layout.detail_mea',compact('id_mea'));
		
		
    }
	
	public function import1(Request $request)
    {
        //
		$id_mea=$request->id_mea;
		 $vidm=DB::table('verifikasi_id_mea')->where('id','=',Auth::user()->id)->get()->count();
			if($vidm == 0){
				DB::table('verifikasi_id_mea')->insert([
				'id_user' => Auth::user()->id,
				'id_mea' => $request->id_mea,
				
			]);
			}else if($vidm > 0){
				DB::table('verifikasi_id_mea')->where('id_user','=',Auth::user()->id)->update([
				'id_user' => Auth::user()->id,
				'id_mea' => $request->id_mea,
				
			]);
			}
            $file = $request->file('file');

            Excel::import(new MeaImportCollection, $file);
            //Excel::import(new PesertaImport, $file);
            //Excel::import(new PesertaImportHeader, $file);

            return view('layout.detail_mea',compact('id_mea'));

}
public function tindak_lanjut(Request $request)
    {
        //
		$acak = rand(10000, 99999);
		$dokumentasi_closing	="(".$acak.") ".request()->dokumentasi_closing->getClientOriginalName();
		$id_mea=$request->id_mea;
		$m=DB::table('detail_mea')->where('id',$request->id_detail_mea)->get()->first();
		if($m->dokumentasi_closing != null){
		unlink(public_path('detail_mea/'.$m->dokumentasi_closing));
		}
		
		$id_mea=$request->id_mea;
		$id_detail_mea=$request->id_detail_mea;
		$status=$request->status;
		 DB::table('detail_mea')->where('id','=',$id_detail_mea)->update([
			'status' => $status,
			'tanggal_closing' => date('Y-m-d',strtotime($request->tgl)),
			'dokumentasi_closing' => $dokumentasi_closing,
			'tindak_lanjut' => $request->tindak_lanjut,
			'penindak_lanjut' => $request->id_user,
			'notifikasi' => 'BBS',
			]);
		request()->dokumentasi_closing->move(public_path('detail_mea'),$dokumentasi_closing);
		/** $mea=DB::table('mea')->where('id',$id_mea)->get()->first();
		$user=DB::table('users')->where('penanggung_jawab','=',$mea->wilayah)->get()->first();
		
		if($user){
		try{  
				Mail::send('email.email_mea', ['pic' => $user->name, 'id_mea' => $id_mea], function ($message) use ($user)
					{
						$r="ariodw44@gmail.com";
						$message->subject('test');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r); 
					}); 
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
		}
				
		$user=DB::table('users')->where('penanggung_jawab','=',$mea->lokasi)->get()->first();
		if($user){
		try{  
				Mail::send('email.email_mea', ['pic' => $user->name, 'id_mea' => $id_mea], function ($message) use ($user)
					{
						$r="ariodw44@gmail.com";
						$message->subject('test');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r); 
					}); 
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
		}
				
		$user=DB::table('users')->where('id','=',$mea->penyusun1)->get()->first();
		if($user){
		try{  
				Mail::send('email.email_mea', ['pic' => $user->name, 'id_mea' => $id_mea], function ($message) use ($user)
					{
						$r="ariodw44@gmail.com";
						$message->subject('test');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r); 
					}); 
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
		}
		$user=DB::table('users')->where('id','=',$mea->penyusun2)->get()->first();
		if($user){
		try{  
				Mail::send('email.email_mea', ['pic' => $user->name, 'id_mea' => $id_mea], function ($message) use ($user)
					{
						$r="ariodw44@gmail.com";
						$message->subject('test');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r); 
					}); 
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}
		}		**/

            return view('layout.detail_mea',compact('id_mea'));
}
public function refresh_detail_mea(Request $request)
    {
		$id_detail_mea=$request->id_detail_mea;
		$detail=DB::table('detail_mea')->where('id',$id_detail_mea)->get()->first();
		
		if($detail->tindak_lanjut != null){
		echo "
		
		<img style='margin:auto; height:200px; width:100%;' src='".url('/')."/detail_mea/".$detail->dokumentasi_closing."' >
		<table class='table table-bordered'>
			<tr>
				<td style='width:140px;'>Tanggal Closing</td>
				
				<td style='width:10px;'>:</td>
				
				<td>".date('d-M-Y',strtotime($detail->tanggal_closing))."</td>
			</tr>
			
			<tr>
				<td style='width:140px;'>Status</td>
				
				<td style='width:10px;'>:</td>
				
				<td>".$detail->status."</td>
			</tr>
			
			<tr>
				<td style='width:140px;'>Tindak Lanjut</td>
				
				<td style='width:10px;'>:</td>
				
				<td>".$detail->tindak_lanjut."</td>
			</tr>
		
			
		</table>
		
		<select name='status' onchange='dokumen(this.value)'>
                      <option>--Pilih--</option>
                      <option value='Open'>Open</option>
                      <option value='Closed'>Closed</option>
                      
        </select>
		
			<div style='display:none;'>
				<form id='status' action='".url('/updatestatus')."' method='post'> 
						<input type='hidden' name='_token' value='".csrf_token()."'>
						<input type='hidden' name='id' value='".$detail->id."'>
						<input type='hidden' name='id_mea' value='".$detail->id_mea."'>
						<input type='hidden' name='status' id='text' value=''>
						<button type='submit' class='btn btn-primary'>save</button></a>
				</form>
			</div>
		
		<script type='text/javascript'>
			function dokumen(value) {
	  
			$('#text').val(value);
			document.getElementById('status').submit();
			}
		</script> 
		";
		}else{
			echo "Tidak ada Tindak Lanjut Pada Detail Mea Ini";
		}
    }
	
	 public function export_detail_mea()
    {
        //
		return view('export');
    } 
	
	 public function refresh_tindak_lanjut(Request $request)
    {
        //
		echo "
		
			<input type='hidden' name='_token' value='".csrf_token()."'>
			<input type='hidden' name='id_mea' value='".$request->id_mea."'>
			<div class='form-line'>
			<label >Tindak Lanjut</label>
			<input type='hidden' name='id_detail_mea' value='".$request->id_detail_mea."'>
			<textarea class='form-control' name='tindak_lanjut'></textarea>
			</div>
			<div class='form-line'>
			<input type='hidden' id='rr' name='status' value='Closed'>
			<label >Status</label>
			<select class='form-control' id='zoneSelect2' onchange='updateChar();'>
			<option>--Pilih--</option>
			<option value='Open'>Open</option>
			<option value='Closed'>Closed</option>
			</select>
			<input type='hidden' name='id_user' value='".$request->id_user."'>
			</div>
			<div class='form-line'>
			<label for='file'>Dokumentasi</label>
			<input type='file' class='form-control' name='dokumentasi_closing' onchange='validasiFil()' id='fil' placeholder=''>
			</div>
			
		";	
		
    }
	
	public function notif_mea(Request $request)
    {
        //
		$id_mea=$request->id_mea;

		
		if($request->status == "BBS"){
			if($request->tanda == 1){
			DB::table('detail_mea')->where('id','=',$request->id_detail_mea)->update([
				'notifikasi' => 'BS2',
				]);
			}else if($request->tanda == 2){
			DB::table('detail_mea')->where('id','=',$request->id_detail_mea)->update([
				'notifikasi' => 'BS1',
				]);
			}
		}else if($request->status == "BS1" or $request->status == "BS2"){
			
			DB::table('detail_mea')->where('id','=',$request->id_detail_mea)->update([
				'notifikasi' => 'B',
				]);
			
		}
		
		return view('layout.detail_mea',compact('id_mea'));
		
    }
	
	public function updatestatus(Request $request)
    {
        //
		
		$id_mea=$request->id_mea;
		$penindak_lanjut=DB::table('detail_mea')->where('id',$request->id)->get()->first();	
			DB::table('detail_mea')->where('id','=',$request->id)->update([
				'status' => $request->status,
				'penindak_lanjut' => $penindak_lanjut->penindak_lanjut,
				'status_penindaklanjut' => 'BB',
				]);
		
		
		return view('layout.detail_mea',compact('id_mea'));
		
	}
	
	public function notif_penindaklanjut(Request $request)
    {
        //
		$id_mea=$request->id_mea;
			
			DB::table('detail_mea')->where('id','=',$request->id_detail_mea)->update([
				'status_penindaklanjut' => $request->status_penindaklanjut,
				]);
		
		
		return view('layout.detail_mea',compact('id_mea'));
		
	}
}	