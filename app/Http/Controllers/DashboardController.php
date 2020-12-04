<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\dashboard;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		
		//$dashboard=dashboard::where(DB::raw('YEAR(date)='.date('Y'))); 
		$tahundashboard=2020;
		return view('layout.dashboard',compact('tahundashboard'));
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
		bulanan::create([
		'bulan' => $request->bulan,
		'tahun' => $request->tahun,
		'arsip' => $request->arsip,
		]);
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
		bulanan::find($id)->delete();
		return redirect()->route('bulanan.index')->with('hapus','Berhasil delete');
    }
	
	 public function dashboardtahun(request $request)
    {
        //
		$tahundashboard=$request->tahundashboard;
		return view('layout.dashboard',compact('tahundashboard'));
    }
}
