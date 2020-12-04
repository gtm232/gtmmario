@extends('base.app')
@section('content')
<script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css',
	
  ],
   file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: 'kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'KCFinder',
            width: 700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    }
//  ...
});
  </script>
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->

				<!-- Modal -->
				
				
				
				<div class="modal fade" id="bast" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form id="jd" action="<?php echo url('/tambah_dokumen'); ?>" method="post"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
							<input type="hidden" name="jenis_dokumen" id="text" value="BAST">
							
								<div class="form-group">					
									<label for="judul">PGN</label>					
									<select style="margin: 5px;" name="pic1" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
								</div>		

								<div class="form-group">					
									<label for="judul">Pihak Ke 2</label>					
									<select style="margin: 5px;" name="pic2" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','!=','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
								</div>
								
								<div class="form-group">					
									<label >Tanggal Surat</label>					  
									<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
								</div>
								
								<div class="form-group">
									<label for="judul">Harga yang dibayarkan</label>
									<input type="text" id="harga_db" name="harga_yangdibayarkan" class="form-control" >
								</div>
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				
				<div class="modal fade" id="bap" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form id="jd" action="<?php echo url('/tambah_dokumen'); ?>" method="post"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
							<input type="hidden" name="jenis_dokumen" id="text" value="BAP">
							
								<div class="form-group">					
									<label for="judul">PGN</label>					
									<select style="margin: 5px;" name="pic1" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
								</div>		

								<div class="form-group">					
									<label for="judul">Pihak Ke 2</label>					
									<select style="margin: 5px;" name="pic2" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','!=','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
								</div>
								
								<div class="form-group">					
									<label >Tanggal Surat</label>					  
									<input style="background:#ffff;" type="text" class="form-control" id="tgl11" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
								</div>
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				
				<div class="modal fade" id="ba_nego" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form id="jd" action="<?php echo url('/tambah_dokumen'); ?>" method="post"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
							<input type="hidden" name="jenis_dokumen" id="text" value="BA Nego">
							
								<div class="form-group">					
									<label for="judul">PGN</label>					
									<select style="margin: 5px;" name="pic1" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
									<select style="margin: 5px;" name="pic2" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
									<select style="margin: 5px;" name="pic3" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
								</div>		

								<div class="form-group">					
									<label for="judul">Pihak Ke 2</label>					
									<select style="margin: 5px;" name="pic4" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','!=','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
									<select style="margin: 5px;" name="pic5" class="form-control" required="required">
										<option>--Pilih--</option>
										<?php
										$picpgn=DB::table('pic_area')->where('perusahaan','!=','PT Perusahaan Gas Negara Tbk')->get();
										?>
										@foreach($picpgn as $picpgn)
										<option value="{{$picpgn->id}}">{{$picpgn->nama}}</option>
										@endforeach
										
									</select>
									
								</div>	
								
								<div class="form-group">					
									<label for="judul">Masa Pekerjaan (Hari)</label>					
									<input type="number" id="masa_pekerjaan" name="masa_pekerjaan" class="form-control" required="required">				
								</div>	

								<div class="form-group">
									<label for="judul">Harga Penawaran</label>
									<input type="text" id="harga_penawaran" name="harga_penawaran" class="form-control" >
								</div>
								
								<div class="form-group">
									<label for="judul">Harga Kesepakatan</label>
									<input type="text" id="harga_kesepakatan" name="harga_kesepakatan" class="form-control" >
								</div>
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				
				<div class="modal fade" id="spk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form id="jd" action="<?php echo url('/tambah_dokumen'); ?>" method="post"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
							<input type="hidden" name="jenis_dokumen" id="text" value="SPK">
							
								<div class="form-group">					
									<label >Tanggal Surat</label>					  
									<input style="background:#ffff;" type="text" class="form-control" id="tgl10" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
								</div>
							
								<div class="form-group">					
									<label for="judul">Lokasi Pekerjaan</label>					
									<input type="text" id="lokasi_pekerjaan" name="lokasi_pekerjaan" class="form-control" required="required">				
								</div>
								
								<div class="form-group">					
									<label for="judul">Masa Pekerjaan (Hari)</label>					
									<input type="number" id="masa_pekerjaan" name="masa_pekerjaan" class="form-control" required="required">				
								</div>	

								<div class="form-group">
									<label for="judul">Harga Pekerjaan</label>
									<input type="text" id="harga_pekerjaan" name="harga_pekerjaan" class="form-control" >
								</div>
								
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					  </div>
					  </form>
					</div>
				  </div>
				</div>
				<!-- Akhir Modal -->
				
				<div class="row page-titles" style="margin-bottom:20px; text-align:center;">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Pembuatan Surat</h3>
                        
                    </div>
                   
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block" >
            
            <div class="card-body ">
			<br>
              <div class="table-responsive" style="margin:15px;">
			@if(Auth::user()->hak_akses == "admin")
            <select class="form-line" id="dokumen" onchange="dokumen(this.value)">
					<option>Pilih</option>
					<option value="Undangan">Undangan</option>
					<option value="BA Nego">BA Nego</option>
					<option value="SPK">SPK</option>
					<option value="BAP">BAP</option>
					<option value="BAST">BAST</option>
					
			</select>
			@endif	
			
				<div style="display:none;">
				<form id="jd" action="<?php echo url('/tambah_dokumen'); ?>" method="post"> 
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
						<input type="hidden" name="jenis_dokumen" id="text" value="">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div> 
					<br>
					<br>
			

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Perihal</th>
                      <th>Jenis Surat</th>
					  <th>Status</th>
					  @if(Auth::user()->hak_akses == "admin")
					  <th>Catatan</th>
                      @endif 
					  <th>Opsi</th>
					
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($pembuatan_surat as $pbs)
					
				  <?php $catatan=$pbs->catatan;?>
                    <tr>
					
					  <td>{{$pbs->perihal}}</td>
                      <td>{{$pbs->jenis_dokumen}}</td>
					  <td>{{$pbs->status}}</td>
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
						<!-- Large modal -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>

							<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-lg">
								<div class="modal-content">
									<div style="margin:15px;" >
									  <?php
										echo $pbs->catatan;
									  ?>
									</div>  
								</div>
							  </div>
							</div>

							
					  </td>
					  @endif
					 
					<td>
					 
					
					@if(Auth::user()->hak_akses == "user" and $pbs->status == "Belum Konfirmasi") 
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a>
					<form id="hapus{{$no}}" method="post" style="display:none; margin-right:5px; float:left" action="{{ route('pembuatan_surat.destroy',$pbs->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					@endif
					
					@if(Auth::user()->hak_akses == "admin") 
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a>
					<form id="hapus{{$no}}" method="post" style="display:none; margin-right:5px; float:left" action="{{ route('pembuatan_surat.destroy',$pbs->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					@endif
					
					@if(Auth::user()->hak_akses == "admin" and $pbs->status != "Ok")
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('revisi{{$no}}').submit()"><i class="material-icons">colorize</i></a>
					<form id="revisi{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/selesai_revisi');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id_pembuatan_surat" value="{{$pbs->id}}">
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$pbs->id_laporan_pekerjaan}}">
					<input type="submit" class="btn btn-success" value="Revisi" />
					</form>
					@endif
					
					<?php
					$pic3=DB::table('laporan_pekerjaan')->where('id',$pbs->id_laporan_pekerjaan)->get()->first();
					$pic_koordinator=DB::table('users')->where('id',Auth::user()->id)->get()->first();
					?>
					
					@if($pic_koordinator->hak_akses == "Koordinator" and $pbs->status == "Cek Koordinator")
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('cek_koordinator{{$no}}').submit()"><i class="material-icons">done</i></a>
					<form id="cek_koordinator{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/cek_koordinator');?>" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$pbs->id_laporan_pekerjaan}}">
								<input type="hidden" name="id" value="{{$pbs->id}}">
								<input type="submit" class="btn btn-success" value="Verifikasi" />
					</form>
					
					<div class="modal fade bd-example-modal-lg" id="catatan_revisi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form class="form-group"  style="float:left; margin-right:5px;" action="<?php echo url('/revisi');?>" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id" value="{{$pbs->id}}">
								
								<textarea name="catatan" id="catatan">
									<!-- isi surat -->
										
										<div class="row" id="source-html">
										<div style="font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" class="col-lg-12">
											<?php
												$u=DB::table('pembuatan_surat')->where('id',$pbs->id)->get()->first(); 
												if($u->jenis_dokumen == "Undangan"){
											?> 
													<div class="card" style="margin:auto; padding:20px; width:600px;">
														
															<table style=" font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" border="0">
																<tr>
																	<td valign="top">Nomor</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->nomor_surat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Sifat</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->sifat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Lampiran</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->lampiran}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Perihal</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->perihal}}</td> 
																</tr>
															</table>
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															?>
															<br>
															<table style=" width:200px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
															<tr><td>
															Jakarta {{$tgl}} {{$bln}} {{$thn}}
															</td></tr>
															</table>
															<br>
															<table style=" width:180px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
																<tr><td>
																Kepada Yth
																</td></tr>
																<tr><td>
																<b>{{$u->tujuan}}</b>
																</td></tr>
																<tr><td>
																{{$u->alamat}}
																</td></tr>
															</table>
															
															<?php echo $u->isi; ?>
															<br>
															<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
															<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
															<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>

														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BA Nego"){
											
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															
															
															$thn=date('Y',strtotime ($u->tanggal_surat));
															
															function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
														 
														 
															$terbilangtanggal = $tgl;
															$terbilangtahun = $thn;

															?>
													<div class="card" style="margin:auto; padding:20px; width:600px;">
															<table border="0">
															<tr>
																<td align="left" valign="top" width="100">
																	<img width="60" height="100" src="<?php echo URL::to('/'); ?>/gambar/logopgn.png">
																</td>
																<td style=" font-family: Arial; font-size:14.5;  line-height: 24px; " valign="top" align="center">
																	<div style="width:550px; margin-top:20px;">
																	<b >BERITA ACARA KLARIFIKASI dan NEGOSIASI HARGA </b><br>
																	<?php
																	$p=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
																	?>
																	<b>{{$p->nama_pekerjaan}}</b><br>
																	<b>Nomor:</b> {{$u->nomor_surat}}
																	</div>
																	
																</td>
															</tr>
															</table> <br>
															<div style="margin:0px 10px -20px 10px; text-align:justify;">
															Pada hari {{$hari}} tanggal {{ucwords(terbilang($terbilangtanggal))}} bulan {{$bln}} tahun {{ucwords(terbilang($terbilangtahun))}} ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}) bertempat di Jakarta, kami yang bertanda tangan dibawah ini:
															<br><br>
															
															<?php echo $u->namapic; ?>
															<?php echo $u->isi; ?>
															</div>
													</div>		
											<?php
											}else if($u->jenis_dokumen == "SPK"){
											?>
															<div class="card" style="margin:auto; padding:20px; width:600px;">
														
															<table style=" font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" border="0">
																<tr>
																	<td valign="top">Nomor</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->nomor_surat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Sifat</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->sifat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Lampiran</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->lampiran}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Perihal</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->perihal}}</td> 
																</tr>
															</table>
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															?>
															<br>
															<table style=" width:200px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
															<tr><td>
															Jakarta {{$tgl}} {{$bln}} {{$thn}}
															</td></tr>
															</table>
															<br>
															<table style=" width:180px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
																<tr><td>
																Kepada Yth
																</td></tr>
																<tr><td>
																<b>{{$u->tujuan}}</b>
																</td></tr>
																<tr><td>
																{{$u->alamat}}
																</td></tr>
															</table>
															
															<?php echo $u->isi; ?>
															
															<br>
															<div style="margin:0px 10px 0px 10px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
																<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
																<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
																<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>
															</div>
														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BAP"){
												function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
											?>
													<div class="card" style="margin:auto; padding:80px; width:780px;">
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															$o=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
															?>
															<div style="text-align:center;"><b>BERITA ACARA PEMERIKSAAN</b></div>
															<div style="text-align:center;"><b style="text-align:center;">{{strtoupper($o->nama_pekerjaan)}}</b></div>
															<hr>
															<div style="text-align:center;"><b>Nomor:</b> {{$u->nomor_surat}}</div><br>
															Pada hari <b>{{$hari}}</b> tanggal <b>{{ucwords(terbilang($tgl))}}</b> bulan <b>{{$bln}}</b> 
															tahun <b>{{ucwords(terbilang($thn))}}</b> ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}), kami 
															yang bertanda tangan dibawah ini, dengan merujuk pada :
															<br>
															<br>
															<?php echo $u->isi; ?>
															
														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BAST"){
												function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
											?>
											
															<div class="card" style="margin:auto; padding:20px; width:600px;">
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															$o=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
															?>
															<div style="text-align:center;"><b>BERITA ACARA SERAH TERIMA</b></div>
															<div style="text-align:center;"><b style="text-align:center;">{{strtoupper($o->nama_pekerjaan)}}</b></div>
															<hr>
															<div style="text-align:center;"><b>Nomor:</b> {{$u->nomor_surat}}</div><br>
															<div style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">Berita Acara Serah Terima {{$o->nama_pekerjaan}} (<b>"BAST"</b>) ini dibuat dan ditandatangani, di Jakarta pada 
															hari {{$hari}} tanggal {{ucfirst(terbilang($tgl))}} bulan {{$bln}} tahun {{ucfirst(terbilang($thn))}} ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}), 
															oleh dan antara :</div><br>
															
															<?php echo $u->namapic; ?>
															
															<?php echo $u->isi; ?>
															
														
													</div>	
											
											<?php
											}
											?>
										</div>	
									</div>	
									
									<!-- akhir isi surat -->
								</textarea>
								<br>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Revisi</button>
							</form>
					</div>
				  </div>
				</div>

					<a style="float:left; margin-right:5px;" href="javascript:" data-toggle="modal" data-target="#catatan_revisi"><i class="material-icons">clear</i></a>
					
					@endif
					
					@if(Auth::user()->id == $pic3->pic and $pbs->status == "Open")
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('cek_pic{{$no}}').submit()"><i class="material-icons">done</i></a>
					<form id="cek_pic{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/cek_pic');?>" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$pbs->id_laporan_pekerjaan}}">
								<input type="hidden" name="id" value="{{$pbs->id}}">
								<input type="submit" class="btn btn-success" value="Verifikasi" />
					</form>
					
				<div class="modal fade bd-example-modal-lg" id="catatan_revisi" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-lg">
					<div class="modal-content">
						<form class="form-group"  style="float:left; margin-right:5px;" action="<?php echo url('/revisi');?>" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="id" value="{{$pbs->id}}">
								
								<textarea name="catatan" id="catatan">
									<!-- isi surat -->
										
										<div class="row" id="source-html">
										<div style="font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" class="col-lg-12">
											<?php
												$u=DB::table('pembuatan_surat')->where('id',$pbs->id)->get()->first(); 
												if($u->jenis_dokumen == "Undangan"){
											?> 
													<div class="card" style="margin:auto; padding:20px; width:600px;">
														
															<table style=" font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" border="0">
																<tr>
																	<td valign="top">Nomor</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->nomor_surat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Sifat</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->sifat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Lampiran</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->lampiran}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Perihal</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->perihal}}</td> 
																</tr>
															</table>
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															?>
															<br>
															<table style=" width:200px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
															<tr><td>
															Jakarta {{$tgl}} {{$bln}} {{$thn}}
															</td></tr>
															</table>
															<br>
															<table style=" width:180px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
																<tr><td>
																Kepada Yth
																</td></tr>
																<tr><td>
																<b>{{$u->tujuan}}</b>
																</td></tr>
																<tr><td>
																{{$u->alamat}}
																</td></tr>
															</table>
															
															<?php echo $u->isi; ?>
															<br>
															<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
															<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
															<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>

														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BA Nego"){
											
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															
															
															$thn=date('Y',strtotime ($u->tanggal_surat));
															
															function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
														 
														 
															$terbilangtanggal = $tgl;
															$terbilangtahun = $thn;

															?>
													<div class="card" style="margin:auto; padding:20px; width:600px;">
															<table border="0">
															<tr>
																<td align="left" valign="top" width="100">
																	<img width="60" height="100" src="<?php echo URL::to('/'); ?>/gambar/logopgn.png">
																</td>
																<td style=" font-family: Arial; font-size:14.5;  line-height: 24px; " valign="top" align="center">
																	<div style="width:550px; margin-top:20px;">
																	<b >BERITA ACARA KLARIFIKASI dan NEGOSIASI HARGA </b><br>
																	<?php
																	$p=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
																	?>
																	<b>{{$p->nama_pekerjaan}}</b><br>
																	<b>Nomor:</b> {{$u->nomor_surat}}
																	</div>
																	
																</td>
															</tr>
															</table> <br>
															<div style="margin:0px 10px -20px 10px; text-align:justify;">
															Pada hari {{$hari}} tanggal {{ucwords(terbilang($terbilangtanggal))}} bulan {{$bln}} tahun {{ucwords(terbilang($terbilangtahun))}} ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}) bertempat di Jakarta, kami yang bertanda tangan dibawah ini:
															<br><br>
															
															<?php echo $u->namapic; ?>
															<?php echo $u->isi; ?>
															</div>
													</div>		
											<?php
											}else if($u->jenis_dokumen == "SPK"){
											?>
															<div class="card" style="margin:auto; padding:20px; width:600px;">
														
															<table style=" font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;" border="0">
																<tr>
																	<td valign="top">Nomor</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->nomor_surat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Sifat</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->sifat}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Lampiran</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->lampiran}}</td>
																</tr>
																
																<tr>
																	<td valign="top">Perihal</td>
																	<td valign="top">:</td>
																	<td valign="top">{{$u->perihal}}</td> 
																</tr>
															</table>
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															?>
															<br>
															<table style=" width:200px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
															<tr><td>
															Jakarta {{$tgl}} {{$bln}} {{$thn}}
															</td></tr>
															</table>
															<br>
															<table style=" width:180px; font-family: Arial; font-size:14.5;  line-height: 24px; text-align:justify;">
																<tr><td>
																Kepada Yth
																</td></tr>
																<tr><td>
																<b>{{$u->tujuan}}</b>
																</td></tr>
																<tr><td>
																{{$u->alamat}}
																</td></tr>
															</table>
															
															<?php echo $u->isi; ?>
															
															<br>
															<div style="margin:0px 10px 0px 10px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
																<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
																<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
																<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>
															</div>
														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BAP"){
												function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
											?>
													<div class="card" style="margin:auto; padding:80px; width:780px;">
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															$o=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
															?>
															<div style="text-align:center;"><b>BERITA ACARA PEMERIKSAAN</b></div>
															<div style="text-align:center;"><b style="text-align:center;">{{strtoupper($o->nama_pekerjaan)}}</b></div>
															<hr>
															<div style="text-align:center;"><b>Nomor:</b> {{$u->nomor_surat}}</div><br>
															Pada hari <b>{{$hari}}</b> tanggal <b>{{ucwords(terbilang($tgl))}}</b> bulan <b>{{$bln}}</b> 
															tahun <b>{{ucwords(terbilang($thn))}}</b> ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}), kami 
															yang bertanda tangan dibawah ini, dengan merujuk pada :
															<br>
															<br>
															<?php echo $u->isi; ?>
															
														
													</div>	
											<?php
											}else if($u->jenis_dokumen == "BAST"){
												function penyebut($nilai) {
																$nilai = abs($nilai);
																$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
																$temp = "";
																if ($nilai < 12) {
																	$temp = " ". $huruf[$nilai];
																} else if ($nilai <20) {
																	$temp = penyebut($nilai - 10). " belas";
																} else if ($nilai < 100) {
																	$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
																} else if ($nilai < 200) {
																	$temp = " seratus" . penyebut($nilai - 100);
																} else if ($nilai < 1000) {
																	$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
																} else if ($nilai < 2000) {
																	$temp = " seribu" . penyebut($nilai - 1000);
																} else if ($nilai < 1000000) {
																	$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
																} else if ($nilai < 1000000000) {
																	$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
																} else if ($nilai < 1000000000000) {
																	$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
																} else if ($nilai < 1000000000000000) {
																	$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
																}     
																return $temp;
															}
														 
															function terbilang($nilai) {
																if($nilai<0) {
																	$hasil = "minus ". trim(penyebut($nilai));
																} else {
																	$hasil = trim(penyebut($nilai));
																}     		
																return $hasil;
															}
											?>
											
															<div class="card" style="margin:auto; padding:20px; width:600px;">
															
															<?php 
															$tgl=date('d',strtotime ($u->tanggal_surat)); 
															$bln1=date('M',strtotime ($u->tanggal_surat));
															$hari1=date('D',strtotime ($u->tanggal_surat));
															if($hari1 == "Mon"){
															$hari="Senin";	
															}else if($hari1 == "Tue"){
															$hari="Selasa";	
															}else if($hari1 == "Wed"){
															$hari="Rabu";	
															}else if($hari1 == "Thu"){
															$hari="Kamis";	
															}else if($hari1 == "Fri"){
															$hari="Jumat";	
															}else if($hari1 == "Sat"){
															$hari="Sabtu";	
															}else if($hari1 == "Sun"){
															$hari="Minggu";	
															}
															
															if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Feb"){
															$bln="Februari";	
															}else if($bln1 == "Mar"){
															$bln="Maret";	
															}else if($bln1 == "Apr"){
															$bln="April";	
															}else if($bln1 == "May"){
															$bln="Mei";	
															}else if($bln1 == "Jun"){
															$bln="Juni";	
															}else if($bln1 == "Jul"){
															$bln="Juli";	
															}else if($bln1 == "Jan"){
															$bln="Januari";	
															}else if($bln1 == "Aug"){
															$bln="Agustus";	
															}else if($bln1 == "Sep"){
															$bln="September";	
															}else if($bln1 == "Oct"){
															$bln="Oktober";	
															}else if($bln1 == "Nov"){
															$bln="November";	
															}else if($bln1 == "Dec"){
															$bln="Desember";	
															} 
															$thn=date('Y',strtotime ($u->tanggal_surat));
															$o=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
															?>
															<div style="text-align:center;"><b>BERITA ACARA SERAH TERIMA</b></div>
															<div style="text-align:center;"><b style="text-align:center;">{{strtoupper($o->nama_pekerjaan)}}</b></div>
															<hr>
															<div style="text-align:center;"><b>Nomor:</b> {{$u->nomor_surat}}</div><br>
															<div style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">Berita Acara Serah Terima {{$o->nama_pekerjaan}} (<b>"BAST"</b>) ini dibuat dan ditandatangani, di Jakarta pada 
															hari {{$hari}} tanggal {{ucfirst(terbilang($tgl))}} bulan {{$bln}} tahun {{ucfirst(terbilang($thn))}} ({{date('d-m-Y',strtotime ($u->tanggal_surat))}}), 
															oleh dan antara :</div><br>
															
															<?php echo $u->namapic; ?>
															
															<?php echo $u->isi; ?>
															
														
													</div>	
											
											<?php
											}
											?>
										</div>	
									</div>	
									
									<!-- akhir isi surat -->
								</textarea>
								<br>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Revisi</button>
							</form>
					</div>
				  </div>
				</div>

					<a style="float:left; margin-right:5px;" href="javascript:" data-toggle="modal" data-target="#catatan_revisi"><i class="material-icons">clear</i></a>
					@endif
					
					@if(Auth::user()->hak_akses == "admin" and $pbs->status == "Ok")
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('arsipkan{{$no}}').submit()"><i class="material-icons">description</i></a>
					<form id="arsipkan{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/arsip');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$pbs->id}}">
					<input type="hidden" name="ps" value="ps">
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$pbs->id_laporan_pekerjaan}}">
					<input type="submit" class="btn btn-success" value="Arsipkan" />
					</form>
					@endif
					
						
					<!--<form class="form-group"  style="float:left; margin-right:5px;" action="<?php echo url('/lihat_pembuatan_surat');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$pbs->id}}">
					<input type="submit" class="btn btn-primary" value="Lihat {{$pbs->id}}" />
					</form>
					
					<form class="form-group"  style="float:left; margin-right:5px;" action="<?php echo url('/print_dokumen');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$pbs->id}}">
					<input type="submit" class="btn btn-primary" value="PDF" />
					</form>-->
						
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('lihat{{$no}}').submit()"><i class="material-icons">remove_red_eye</i></a>
					<form id="lihat{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/print_doc');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$pbs->id}}">
					<input type="submit" class="btn btn-primary" value="Lihat" />
					</form>
					
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('history{{$no}}').submit()"><i class="material-icons">history</i></a>
					<form id="history{{$no}}" class="form-group"  style="display:none; float:left; margin-right:5px;" action="<?php echo url('/history');?>" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id_pembuatan_surat" value="{{$pbs->id}}">
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$pbs->id_laporan_pekerjaan}}">
					<input type="submit" class="btn btn-primary" value="Lihat" />
					</form>
					</td>
					
					  
                    </tr>
					<?php $no++; $catatan=$pbs->catatan;?>
                   @endforeach
                  </tbody>
                </table>
				
				<div>
				<?php //echo $catatan ?> 
				</div>
				
              </div>
            </div>
         
							   
							   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection

<script type="text/javascript">


   function dokumen(value) {
	var dokumen = value;
	if(dokumen == "Undangan"){
		$('#text').val(value);
		document.getElementById('jd').submit()
	}else if(dokumen == "BA Nego"){
		$("#ba_nego").modal();
		$('#text').val(value);
	}else if(dokumen == "SPK"){
		$("#spk").modal();
		$('#text').val(value);
	}else if(dokumen == "BAP"){
		$("#bap").modal();
		$('#text').val(value);
	}else if(dokumen == "BAST"){
		$("#bast").modal();
		$('#text').val(value);
	}
}
</script> 