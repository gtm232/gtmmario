<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$users=users::all();
		return view('layout.user',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
		
    }
	
	 public function report_soal(Request $request)
    {
		return view('layout.report_soal')->with('id_user',$request->id_user);
	}
	
	 public function edit_user(Request $request)
    {
		return view('edit.edit_user')->with('id_user',$request->id_user);
	}
	
	
	public function hapus_user(Request $request)
    {
        //
		if($request->gambar != null ){
			unlink(public_path('img/gambar/'.request()->gambar));
		}
		DB::table('users')->where('id', '=', $request->id_user)->delete();
		return redirect()->route('user.index')->with('success','');
    }
	
	public function edit_user_proses(Request $request)
    {
        //
		$cu = DB::table('users')->where([['username',$request->username],['id','!=',$request->id_user]])->get()->first();
		$ce = DB::table('users')->where([['email','=',$request->email],['id','!=',$request->id_user]])->get()->first();
		
		if(!$cu and !$ce){
		$acak = rand(10000, 99999);
		if(request()->gambar != null){
		$gambar	="(".$acak.") ".request()->gambar->getClientOriginalName();
		request()->gambar->move(public_path('img/gambar'),$gambar);
		if(request()->old_gambar != null){
		unlink(public_path('img/gambar/'.request()->old_gambar));
		}
		}else{
		$gambar=request()->old_gambar;
		}
		
		if(request()->password != null){
		$password= bcrypt(request()->password);
		}else{
		$password= request()->old_password;	
		}
		
		users::find($request->id_user)->update([
		'username' => $request->username,
		'name' => $request->nama,
		'email' => $request->email,
		'password' => $password,
		'hak_akses' => $request->hak_akses,
		'gambar' => $gambar,
		]);
		}
		return redirect()->route('user.index')->with('success','');
    }
	
	public function input_user_proses(Request $request)
    {
        //
		$cu = DB::table('users')->where('username','=',$request->username)->get()->first();
		$ce = DB::table('users')->where('email','=',$request->email)->get()->first();
		
		if(!$cu and !$ce){
		$acak = rand(10000, 99999);
		if(request()->gambar != null){
		$gambar	="(".$acak.") ".request()->gambar->getClientOriginalName();
		request()->gambar->move(public_path('img/gambar'),$gambar);
		
		}else{
		$gambar="";
		}
		
		users::create([
		'username' => $request->username,
		'name' => $request->nama,
		'email' => $request->email,
		'password' => bcrypt($request->password),
		'hak_akses' => $request->hak_akses,
		'gambar' => $gambar,
		'pt' => $request->pt,
		]);
		}
		return redirect()->route('user.index')->with('success','Berhasil Register User');
		
	}
	
	public function tambah_user(Request $request)
    {
		return view('auth.register');
	}
}
