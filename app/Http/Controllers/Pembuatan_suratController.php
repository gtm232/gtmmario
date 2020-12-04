<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Pembuatan_surat;

use Mail;

class Pembuatan_suratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_dokumen(Request $request)
    {
        //
		$jd=$request->jenis_dokumen;
		if($jd == "Undangan"){
			$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
			$jd=$request->jenis_dokumen;
			return view('input.pembuatan_surat',compact('id_laporan_pekerjaan'),compact('jd')); 
		}else if($jd == "BA Nego"){
			$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
			$jd=$request->jenis_dokumen;
			$area=$request->area;
			$masa_pekerjaan=$request->masa_pekerjaan;
			$pic1=$request->pic1;
			$pic2=$request->pic2;
			$pic3=$request->pic3;
			$pic4=$request->pic4;
			$pic5=$request->pic5;
			$harga_penawaran1=substr($request->harga_penawaran,3);
			$harga_penawaran = str_replace(".", "", $harga_penawaran1);
			$harga_kesepakatan1=substr($request->harga_kesepakatan,3);
			$harga_kesepakatan = str_replace(".", "", $harga_kesepakatan1);
			return view('input.pembuatan_surat',compact('id_laporan_pekerjaan','jd','area','masa_pekerjaan','harga_penawaran','harga_kesepakatan','pic1','pic2','pic3','pic4','pic5')); 
		}else if($jd == "SPK"){
			$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
			$jd=$request->jenis_dokumen;
			$tanggal_surat=$request->tanggal_surat;
			$lokasi_pekerjaan=$request->lokasi_pekerjaan;
			$masa_pekerjaan=$request->masa_pekerjaan;
			$harga_pekerjaan=$request->harga_pekerjaan;
			
			return view('input.pembuatan_surat',compact('id_laporan_pekerjaan','jd','tanggal_surat','lokasi_pekerjaan','masa_pekerjaan','harga_pekerjaan')); 
		}else if($jd == "BAP"){
			$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
			$jd=$request->jenis_dokumen;
			$pic1=$request->pic1;
			$pic2=$request->pic2;
			$tanggal_surat=$request->tanggal_surat;
			return view('input.pembuatan_surat',compact('id_laporan_pekerjaan','jd','pic1','pic2','tanggal_surat')); 
		}else if($jd == "BAST"){
			$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
			$jd=$request->jenis_dokumen;
			$pic1=$request->pic1;
			$pic2=$request->pic2;
			$tanggal_surat=$request->tanggal_surat;
			$harga_yangdibayarkan=$request->harga_yangdibayarkan;
			return view('input.pembuatan_surat',compact('id_laporan_pekerjaan','jd','pic1','pic2','tanggal_surat','harga_yangdibayarkan')); 
		}
		
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambah_dokumen_proses(Request $request)
    {
        //
		$jd=$request->jenis_dokumen;
		if($jd == "Undangan"){
		pembuatan_surat::create([
		'nomor_surat' => $request->nomor_surat,
		'sifat' => $request->sifat,
		'lampiran' => $request->lampiran,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'tujuan' => $request->tujuan,
		'alamat' => $request->alamat,
		'isi' => $request->isi,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "BA Nego"){
		pembuatan_surat::create([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'namapic' => $request->namapic,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "SPK"){
		
			pembuatan_surat::create([
				'nomor_surat' => $request->nomor_surat,
				'sifat' => $request->sifat,
				'lampiran' => $request->lampiran,
				'perihal' => $request->perihal,
				'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
				'tujuan' => $request->tujuan,
				'alamat' => $request->alamat,
				'isi' => $request->isi,
				'status' => "Open",
				'jenis_dokumen' => $request->jenis_dokumen,
				'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
				  ]);
			
		
		}else if($jd == "BAP"){
		pembuatan_surat::create([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "BAST"){
		pembuatan_surat::create([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'namapic' => $request->namapic,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}
		
		$id_pic=DB::table('laporan_pekerjaan')->where('id',$request->id_laporan_pekerjaan)->get()->first();
		$user=DB::table('users')->where('id','=',$id_pic->pic)->get()->first();
		
		/*try{  
				Mail::send('email.email_pembuatan_surat', ['pic' => $user->name, 'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan, 'perihal' => $request->perihal], function ($message) use ($user)
					{
						$r=$user->email;
						$message->subject('test');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to('ariodw44@gmail.com'); 
					}); 
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				} */
		
		
		
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
    }

	public function lihat_pembuatan_surat(Request $request) 
    {
		//$id_pembuatan_surat=$request->id_pembuatan_surat;
		$id_pembuatan_surat=$request->id;
		return view('layout.lihat_pembuatan_surat',compact('id_pembuatan_surat'));
		
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function selesai_revisi(Request $request)
    {
        //
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('edit.pembuatan_surat',compact('id_laporan_pekerjaan','id_pembuatan_surat')); 
		
    }
	
	 public function selesai_revisi_proses(Request $request)
    {
        //
		$jd=$request->jenis_dokumen;
		if($jd == "Undangan"){
		DB::table('pembuatan_surat')->where('id','=',$request->id_pembuatan_surat)->update([
		'nomor_surat' => $request->nomor_surat,
		'sifat' => $request->sifat,
		'lampiran' => $request->lampiran,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'tujuan' => $request->tujuan,
		'alamat' => $request->alamat,
		'isi' => $request->isi,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "BA Nego"){
		DB::table('pembuatan_surat')->where('id','=',$request->id_pembuatan_surat)->update([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'namapic' => $request->namapic,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "SPK"){
		DB::table('pembuatan_surat')->where('id','=',$request->id_pembuatan_surat)->update([
		'nomor_surat' => $request->nomor_surat,
		'sifat' => $request->sifat,
		'lampiran' => $request->lampiran,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'tujuan' => $request->tujuan,
		'alamat' => $request->alamat,
		'isi' => $request->isi,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "BAP"){
		DB::table('pembuatan_surat')->where('id','=',$request->id_pembuatan_surat)->update([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}else if($jd == "BAST"){
		DB::table('pembuatan_surat')->where('id','=',$request->id_pembuatan_surat)->update([
		'nomor_surat' => $request->nomor_surat,
		'perihal' => $request->perihal,
		'tanggal_surat' => date('Y-m-d',strtotime($request->tanggal_surat)),
		'isi' => $request->isi,
		'namapic' => $request->namapic,
		'status' => "Open",
		'jenis_dokumen' => $request->jenis_dokumen,
		'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan,
		
		]);
		}
		
		$id_pic=DB::table('laporan_pekerjaan')->where('id',$request->id_laporan_pekerjaan)->get()->first();
		$user=DB::table('users')->where('id','=',$id_pic->pic)->get()->first();
		
		/**try{  
				Mail::send('email.email_pembuatan_surat', ['pic' => $user->name, 'id_laporan_pekerjaan' => $request->id_laporan_pekerjaan, 'perihal' => $request->perihal], function ($message) use ($user)
					{
						$r=$user->email;
						$message->subject('Review Dokumen Anda');
						$message->from('admin@mario.tamanrifa.com', 'Admin MARIO');
						$message->to($r);
					});
					//return back()->with('alert-success','Berhasil Kirim Email');
				}
				catch (Exception $e){
				  return response (['status' => false,'errors' => $e->getMessage()]);
				}**/
		
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
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
		pembuatan_surat::find($id)->update([
		'nama_user' => $request->nama_user,
		'nama_pekerjaan' =>$request->jenis_pekerjaan,
		'catatan' =>$request->catatan,
		'status' => $request->status,
		]);
		return redirect()->route('pembuatan_surat.index')->with('success','Berhasil di Simpan');
		
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
		
		$i=DB::table('pembuatan_surat')->where('id',$id)->get()->first();
		$id_laporan_pekerjaan=$i->id_laporan_pekerjaan;
		pembuatan_surat::find($id)->delete();
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
    }
	
	public function revisi(Request $request)
    {
        //
		pembuatan_surat::find($request->id)->update([
		'status' => 'Revisi',
		'catatan' => $request->catatan,
		]);
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
		
		
    }
	
	public function cek_pic(Request $request)
    {
        //
		pembuatan_surat::find($request->id)->update([
		'status' => 'Cek Koordinator',
		]);
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
		
    }
	
	public function cek_koordinator(Request $request)
    {
        //
		pembuatan_surat::find($request->id)->update([
		'status' => 'Ok',
		]);
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan')); 
		
    }
	
	public function arsip(Request $request)
    {
        //
		pembuatan_surat::find($request->id)->update([
		'status' => 'Di Arsipkan',
		]);
		return redirect()->route('pembuatan_surat.index')->with('success','Berhasil di Simpan');
		
    }
	
	//file pembuatan surat
	public function files(Request $request)
    {
        //
		$file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id_pembuatan_surat', '=', $request->id)->get();
		$id_pembuatan_surat=$request->id;
		return view('layout.file_pembuatan_surat',compact('file_pembuatan_surat'),compact('id_pembuatan_surat'));
		
    }
	
	public function tambah_file_pembuatan_surat(Request $request)
    {
        //
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('input.file_pembuatan_surat',compact('id_pembuatan_surat'));
		
    }
	
	public function tambah_file_pembuatan_surat_proses(Request $request)
    {
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_file	="(".$acak.") ".request()->file->getClientOriginalName();
		request()->file->move(public_path('file_pembuatan_surat'),$nama_file);
		}else{
		$nama_file="";
		}
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		DB::table('file_pembuatan_surat')->insert([
			'id_pembuatan_surat' => $id_pembuatan_surat,
			'perihal' => $request->perihal,
			'nama_file' => $nama_file,
			]);
		
		$file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id_pembuatan_surat', '=', $id_pembuatan_surat)->get();
		return view('layout.file_pembuatan_surat',compact('file_pembuatan_surat'),compact('id_pembuatan_surat'));
		
    }
	
	public function edit_file_pembuatan_surat(Request $request){
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		$edit_file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id', '=', $request->id)->get()->first();
		return view('edit.file_pembuatan_surat',compact('edit_file_pembuatan_surat'),compact('id_pembuatan_surat'));
		
	}
	
	public function edit_file_pembuatan_surat_proses(Request $request){
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		$acak = rand(10000, 99999);
		if(request()->file != null){
		$nama_file	="(".$acak.") ".request()->file->getClientOriginalName();
		request()->file->move(public_path('file_pembuatan_surat'),$nama_file);
		unlink(public_path('file_pembuatan_surat/'.request()->file_old));
		}else{
		$nama_file=request()->file_old;
		}
		DB::table('file_pembuatan_surat')->where('id','=',$request->id)->update([
			'perihal' => $request->perihal,
			'nama_file' => $nama_file,
			'catatan' => $request->catatan,
			]);
			
		$file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id_pembuatan_surat', '=', $id_pembuatan_surat)->get();
		return view('layout.file_pembuatan_surat',compact('file_pembuatan_surat'),compact('id_pembuatan_surat'));
	}
	
	public function hapus_file_pembuatan_surat(Request $request){
		$id=$request->id;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		DB::table('file_pembuatan_surat')->where('id', '=', $request->id)->delete();
		unlink(public_path('file_pembuatan_surat/'.addslashes(request()->nama_file)));
			
		$file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id_pembuatan_surat', '=', $id_pembuatan_surat)->get();
		return view('layout.file_pembuatan_surat',compact('file_pembuatan_surat'),compact('id_pembuatan_surat'));
	}
	
	public function lihat_file_pembuatan_surat(Request $request)
    {
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		$id=$request->id;
		return view('layout.lihat_file_pembuatan_surat',compact('id_pembuatan_surat','id'));
		
    }

	
	public function tambah_pembuatan_surat_isi(Request $request)
    {
        //
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('input.pembuatan_surat_isi',compact('id_pembuatan_surat'));
		
    }
	
	public function tambah_pembuatan_surat_isi_proses(Request $request)
    {
        //
		DB::table('pembuatan_surat_isi')->insert([
			'id_pembuatan_surat' => $request->id_pembuatan_surat,
			'prihal' => $request->nama_file,
			'isi' => $request->isi,
			]);
		$id=$request->id_pembuatan_surat;
		return view('layout.lihat_pembuatan_surat',compact('id'));
		
    }
	
	
	public function edit_pembuatan_surat_isi(Request $request)
    {
        //
		$id_edit=$request->id_edit;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('edit.pembuatan_surat_isi',compact('id_pembuatan_surat','id_edit'));
		
    }
	
	public function edit_pembuatan_surat_isi_proses(Request $request)
    {
        //
		DB::table('pembuatan_surat_isi')->where('id','=',$request->id)->update([
			'prihal' => $request->nama_file,
			'isi' => $request->isi,
			]);
		$id=$request->id_pembuatan_surat;
		return view('layout.lihat_pembuatan_surat',compact('id'));
		
    }
	
	public function hapus_pembuatan_surat_isi(Request $request)
    {
        //
		DB::table('pembuatan_surat_isi')->where('id','=',$request->id_edit)->delete();
		$id=$request->id_pembuatan_surat;
		return view('layout.lihat_pembuatan_surat',compact('id'));
		
    }
	
	public function lihat_pembuatan_surat_isi(Request $request)
    {
        //
		$id_edit=$request->id_edit;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('layout.lihat_pembuatan_surat_isi',compact('id_pembuatan_surat','id_edit'));
		
    }
	
	public function pembuatan_surat_email()
    {
        // 
		$id_laporan_pekerjaan=$_GET["ip"];
		$pembuatan_surat=pembuatan_surat::where('id_laporan_pekerjaan', '=', $id_laporan_pekerjaan)->get();
		return view('layout.pembuatan_surat',compact('pembuatan_surat'),compact('id_laporan_pekerjaan'));
    }
	
	public function history(Request $request)
    {
        // 
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		$history=DB::table('history')->where('id_pembuatan_surat', '=', $id_pembuatan_surat)->orderBy('id','ASC')->get();
		return view('layout.history',compact('history','id_pembuatan_surat','id_laporan_pekerjaan'));
    }
	
	public function tambah_history(Request $request)
    {
        // 
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		return view('input.history',compact('id_pembuatan_surat','id_laporan_pekerjaan'));
    }
	
	public function tambah_history_proses(Request $request)
    {
		//
		$p=DB::table('history')->where('status','belum')->count();
		if($p == 0){
		request()->file->move(public_path('history'),$request->file->getClientOriginalName());
		DB::table('history')->insert([
			'id_pembuatan_surat' => $request->id_pembuatan_surat,
			'file' => $request->file->getClientOriginalName(),
			'penerima' => $request->pic,
			'status' => 'belum',
			]);
		}
		$history=DB::table('history')->where('id_pembuatan_surat', '=', $request->id_pembuatan_surat)->orderBy('id','ASC')->get();
		$id_pembuatan_surat=$request->id_pembuatan_surat;	
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;	
		return view('layout.history',compact('id_pembuatan_surat','id_laporan_pekerjaan','history'));
    }
	
	public function histori(Request $request)
    {
        // 
		
	/*$result = array();
	$imagedata = base64_decode($request->output);
	$filename = rand(1000, 9999);
	//Location to where you want to created sign image
	$file_name = 'public/history/ttd/'.$filename.'.png';
	file_put_contents($file_name,$imagedata);
	*/
	$hs=DB::table('history')->where('status','belum')->get()->first();
	$hs1=DB::table('history')->where('status','belum')->count();
	if($hs1 != 0 and $request->output != null){
	DB::table('history')->where('id','=',$hs->id)->update([
			'tanggal_menerima' => $request->tanggal,
			'ttd' => $request->output,
			'catatan' => $request->catatan,
			'status' => 'sudah',
			]);
	}
			
	$history=DB::table('history')->where('id_pembuatan_surat', '=', $request->id_pembuatan_surat)->orderBy('id','ASC')->get();
		$id_pembuatan_surat=$request->id_pembuatan_surat;	
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;	
		return view('layout.history',compact('id_pembuatan_surat','id_laporan_pekerjaan','history'));
    }
	
	public function hapus_histori(Request $request){
		$id=$request->id;
		$id_pembuatan_surat=$request->id_pembuatan_surat;
		$p=DB::table('history')->where('file',$request->nama_file)->count();
		DB::table('history')->where('id', '=', $request->id)->delete();
		if($p < 2){
		if(file_exists(public_path('history/'.request()->nama_file))){
		unlink(public_path('history/'.addslashes(request()->nama_file)));
		}else{
			
		}
		}
	$history=DB::table('history')->where('id_pembuatan_surat', '=', $request->id_pembuatan_surat)->orderBy('id','ASC')->get();
		$id_pembuatan_surat=$request->id_pembuatan_surat;	
		$id_laporan_pekerjaan=$request->id_laporan_pekerjaan;	
		return view('layout.history',compact('id_pembuatan_surat','id_laporan_pekerjaan','history'));	
		
	}
	
}
