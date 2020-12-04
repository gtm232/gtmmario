@extends('base.app')
@section('content')

	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

 <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
			
			<table>
				<tr>
				<td>
				<form action="<?php echo url('/dashboard_tahun'); ?>" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="tahundashboard" value="{{$tahundashboard-1}}">
					<button type="submit" class="btn btn-primary"><<</button>
				</form>
				</td>
				<td>
				<form>
				<button type="submit" class="btn btn-primary">{{$tahundashboard}}</button>
				</form>
				</td>
				<td>
				<form action="<?php echo url('/dashboard_tahun'); ?>" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="tahundashboard" value="{{$tahundashboard+1}}">
					<button type="submit" class="btn btn-primary">>></button>
				</form>
				</td>
				</tr>
			</table>

            <!-- Widgets -->
            <div class="row clearfix">
			<a href="javascript:" onclick="document.getElementById('nego').submit()">
                <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
						<?php
						$reimbursement=DB::table('laporan_pekerjaan')->where('tahun',$tahundashboard)->count();
						?>
                            <div style="margin:auto; font-size:30px; margin-top:15px;">{{$reimbursement}}</div>
                        </div>
                        <div class="content">
                            <div class="text">Pekerjaan Reimbursement</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
			</a>	
			
			<form style="display:none;" id="nego" method="post" action="<?php echo url('/pekerjaan_cari'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="cari" value="nego">
								<input type="hidden" name="tahundashboard" value="{{$tahundashboard}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
			</form>
			
			<a href="javascript:" onclick="document.getElementById('berlangsung').submit()">
				<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-expand-effect">
                        <div class="icon">
						<?php
						$pagu_rutin=DB::table('laporan_pekerjaan_pagu')->where('tahun',$tahundashboard)->count();
						?>
                            <div style="margin:auto; font-size:30px; margin-top:15px;">{{$pagu_rutin}}</div>
                        </div>
                        <div class="content">
                            <div class="text">Pagu Rutin</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
			</a>
			<form style="display:none;" id="berlangsung" method="post" action="<?php echo url('/pekerjaan_cari'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="cari" value="berlangsung">
								<input type="hidden" name="tahundashboard" value="{{$tahundashboard}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
			</form>
				
			<a href="javascript:" onclick="document.getElementById('selesai').submit()">	
				<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-grey hover-expand-effect">
                        <div class="icon">
						<?php
						$sparepart=DB::table('laporan_pekerjaan')->where([['tahun',$tahundashboard],['status','Telah Melaporkan Selesainya Pekerjaan'],])->orWhere([['tahun',$tahundashboard],['status','Pemeriksaan Pekerjaan'],])->orWhere([['tahun',$tahundashboard],['status','Serah Terima Pekerjaan'],])->count();
						?>
                            <div style="margin:auto; font-size:30px; margin-top:15px;">{{$sparepart}}</div>
                        </div>
                        <div class="content">
                            <div class="text">Sparepart</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
			</a>	
			<form style="display:none;" id="selesai" method="post" action="<?php echo url('/pekerjaan_cari'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="cari" value="selesai">
								<input type="hidden" name="tahundashboard" value="{{$tahundashboard}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
			</form>
				
				
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
			<div class="row clearfix">
                <!-- Visitors -->
				<div class="card">
				<div class="table-responsive" style="margin:20px;">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-10">
					<div id="graph"></div>
						<pre style="display:none;" id="code" class="prettyprint linenums">
						<?php
						$popay5=0;
						$popay=DB::table('laporan_pekerjaan')->where('tahun',$tahundashboard)->get();
						foreach($popay as $popay){
							$popay2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$popay->id],['jenis_dokumen','SPK'],])->get()->first();
							$popay_param=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$popay->id],['jenis_dokumen','SPK'],])->count();
							if($popay_param >= 1){
							$popay3=DB::table('spk_dev')->where('id_dokumen',$popay2->id)->get();
							foreach($popay3 as $popay3){
							$popay4=DB::table('popay')->where([['id_spk_dev',$popay3->id],['status','Paid']])->sum('rupiah');
							$popay5=$popay5+$popay4;
							}
							}
							//$popay2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$popay->id],['jenis_dokumen','SPK']])->sum('harga');
							//$popay5=$popay5+$popay2;
						}
						
						$tahun_selanjutnya4=0;
						$tahun_selanjutnya=DB::table('laporan_pekerjaan')->where('tahun',$tahundashboard)->where('status','!=','Pekerjaan Diakhiri')->get();
						foreach($tahun_selanjutnya as $tahun_selanjutnya){
							$tahun_selanjutnya2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$tahun_selanjutnya->id],['jenis_dokumen','SPK'],])->get()->first();
							if($tahun_selanjutnya2){
							$tahun_selanjutnya3=DB::table('spk_dev')->where('id_dokumen','=',$tahun_selanjutnya2->id)->where('tahun','>',$tahun_selanjutnya->tahun)->sum('persentasi');
							$ac=($tahun_selanjutnya3/100)*$tahun_selanjutnya2->harga;
							$tahun_selanjutnya4=$tahun_selanjutnya4+$ac;
							}
						}
						
						$luncuran4=0;
						$luncuran=DB::table('laporan_pekerjaan')->where('tahun',($tahundashboard-1))->get();
						foreach($luncuran as $luncuran){
							$luncuran2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$luncuran->id],['jenis_dokumen','SPK'],])->get()->first();
							if($luncuran2){
							$luncuran3=DB::table('spk_dev')->where('id_dokumen','=',$luncuran2->id)->where('tahun','>',$luncuran->tahun)->sum('persentasi');
							$ac=($luncuran3/100)*$luncuran2->harga;
							$luncuran4=$luncuran4+$ac;
							}
						}
						
						$accrue9=0;
						$accrue=DB::table('laporan_pekerjaan')->where('tahun',$tahundashboard)->get();
						foreach($accrue as $accrue){
							$accrue2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$accrue->id],['jenis_dokumen','SPK'],])->get()->first();
							if($accrue2){
							$accrue3=DB::table('spk_dev')->where('id_dokumen',$accrue->id)->get()->first();
							$accrue4=date('Y-m-d',strtotime($accrue2->tanggal));
							$accrue5=date('Y-m-d',strtotime('+'.($accrue2->durasi-1).' days', strtotime($accrue4)));
							$accrue6=date('m',strtotime($accrue5));
								if($accrue6 == 12 and $accrue3){
									$accrue7=DB::table('popay')->where('id_spk_dev',$accrue3->id)->sum('rupiah');
									$accrue8=$accrue2->harga - $accrue7;
									$accrue9=$accrue9 + $accrue8;
								}
							}
						}
						
						$jumlah_spk3=0;
						$jumlah_spk=DB::table('laporan_pekerjaan')->where('tahun',$tahundashboard)->where('status','!=','Pekerjaan Diakhiri')->get();
						foreach($jumlah_spk as $jumlah_spk){
							$jumlah_spk2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$jumlah_spk->id],['jenis_dokumen','SPK']])->sum('harga');
							$jumlah_spk3=$jumlah_spk3 + $jumlah_spk2;
						}
						
						$jumlah_spk_pagu3=0;
						$jumlah_spk_pagu=DB::table('laporan_pekerjaan_pagu')->where('tahun',$tahundashboard)->where('status','!=','Pekerjaan Diakhiri')->get();
						foreach($jumlah_spk_pagu as $jumlah_spk_pagu){
							$jumlah_spk_pagu2=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$jumlah_spk_pagu->id],['jenis_dokumen','SPK']])->sum('harga');
							$jumlah_spk_pagu3=$jumlah_spk_pagu3 + $jumlah_spk_pagu2;
						}
						
						?>
					
						// Use Morris.Bar
						Morris.Bar({
						  element: 'graph',
						  data: [
							{x: 'Reimbursement', y: {{$jumlah_spk3}}},
							{x: 'Pagu Rutin', y: {{$jumlah_spk_pagu3}}},			
							{x: 'Sparepart', y: 0},			
							{x: 'Luncuran Reimbursement', y: {{$luncuran4}}}
						  ],
						  xkey: 'x',
						  ykeys: ['y'],
						  labels: ['Nilai'],
						  barColors: function (row, series, type) {
							if (type === 'bar') {
							  var red = Math.ceil(255 * row.y / this.ymax);
							  return 'rgb(' + red + ',0,0)';
							}
							else {
							  return '#000';
							}
						  }
						});
					</pre>
				</div>
			</div>
			</div>
			</div>
            <!-- #END# CPU Usage -->
           
        </div>
    </section>

</div>
@endsetion