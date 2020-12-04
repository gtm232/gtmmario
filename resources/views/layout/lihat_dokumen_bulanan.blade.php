<html>

	<head>
	<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/catatan/jquery-ui.css">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/css/style.css" rel="stylesheet">
	<link href="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo URL::to('/'); ?>/aset/css/themes/all-themes.css" rel="stylesheet" />
	
	</head>
	
	<body>
	<a href="javascript:" onclick="document.getElementById('backdbln').submit()">
	<i class="material-icons">reply</i>
	</a>
					 
			<div style="display:none;">
					<form id="backdbln" action="<?php echo url('/dokumen_bulanan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
			</div>		
		<?php
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
		?>
		<?php 
			$dokumen_laporan_bulanan=DB::table('dokumen_laporan_bulanan')->where('id','=',$id)->get()->first();
		?>
		<div id="loading" style="display:none; position: absolute; width: 100%;">
			<img style="display: block; margin-left: auto; margin-right: auto; width:40%;" src="<?php echo URL::to('/'); ?>/gambar/Loading_2.gif">
		</div>
		
		<div id="holder2" class="col-md-12 col-12 align-self-center">
			<h3 align="center" style="margin:20px 0px 20px 0px;" class="text-themecolor m-b-0 m-t-0">{{$dokumen_laporan_bulanan->prihal}}</h3>              
		</div>
		
		<div style="width:100%;">
			<div style="margin: 0 auto;">			   
							<?php $dokumen_laporan_bulanan2=DB::table('dokumen_laporan_bulanan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['jenis_laporan',$id_jenis_laporan],['wilayah_operasi',$id_wilayah_operasi],])->get(); ?>
							<div class="card-body ">
								<?php
								$dl=DB::table('notif_catatan_revisi')->where('id_dokumen_laporan',$dokumen_laporan_bulanan->id)->get()->first();
								$dl1=DB::table('notif_catatan_revisi')->where('id_dokumen_laporan',$dokumen_laporan_bulanan->id)->count();
								?>
								
								<table border="0" align="center" style="width:95%;">
									<tr>
									
										<td>
											<select style="" class="form-control" id="dokumen" onchange="dokumen(this.value)">
												<option value="0">-- Silahkan Pilih --</option>
												@foreach($dokumen_laporan_bulanan2 as $dlb)
												<option value="{{$dlb->id}}">{{$dlb->prihal}}</option>
												@endforeach
											</select>
											
											<div style="display:none;">
											<form id="bln" action="<?php echo url('/lihat_dokumen_bulanan'); ?>" method="post">
													<input type="hidden" name="_token" value="{{csrf_token()}}">
													<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
													<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
													<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
													<input type="hidden" name="id" id="text" value="{{$id}}">
													<button type="submit" class="btn btn-primary">save</button></a>
											</form>
											</div>
										</td>
									
										<td width="10">
								
											<a style="" href="javascript:" class="waves-effect" data-toggle="modal" data-target="#exampleModalLong"> <i class="material-icons">attach_file</i></a>
													
											<!-- Modal -->
											<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLongTitle">Attach</h5>
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														
														<div class="modal-body">
															<div class="table-responsive">
																							
																	@if($jenis_laporan->id_tujuan == Auth::user()->id or Auth::user()->hak_akses == "admin")
																		<form style=" margin-right:0px 5px 10px;" action="<?php echo url('/attach'); ?>" method="post">
																			<input type="hidden" name="_token" value="{{csrf_token()}}">
																			<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
																			<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
																			<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
																			<input type="hidden" name="id" value="{{$id}}">
																			<button type="submit" class="btn btn-info">Tambah</button></a>
																		</form>
																	@endif		
																
																<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
																	<thead>
																		<tr>
																			<th>Dokumen</th>
																			@if($jenis_laporan->id_tujuan == Auth::user()->id or Auth::user()->hak_akses == "admin")
																			<th>Opsi</th>
																			@endif	
																		</tr>
																	</thead>
																	<?php $lampiran=DB::table('attach')->where([['id_laporan_bulanan',$id_laporan_bulanan],['id_jenis_laporan',$id_jenis_laporan],['id_wilayah_operasi',$id_wilayah_operasi],])->get(); ?>
																	<tbody>
																	@foreach($lampiran as $lam)
																	<tr>
																		<td>{{$lam->nama_dokumen}}</td>
																		<td>
																			@if($jenis_laporan->id_tujuan == Auth::user()->id or Auth::user()->hak_akses == "admin")
																			<form style="float:left; margin-right:5px;" method="post" action="<?php echo url('/hapus_attach'); ?>">
																			<input type="hidden" name="_token" value="{{csrf_token()}}">
																			<input type="hidden" name="id_attach" value="{{$lam->id}}">
																			<input type="hidden" name="id" value="{{$id}}">
																			<input type="hidden" name="nama_dokumen" value="{{$lam->nama_dokumen}}">
																			<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
																			<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
																			<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
																			<input type="submit" class="btn btn-danger" value="Delete" />
																			</form>
																			@endif
																			<a style="float:left;" href="<?php echo URL::to('/'); ?>/laporan_bulanan/{{$folder->tahun}}/{{$nama_bulan}}/{{$wilayah->wilayah_operasi}}/{{$jenis_laporan->jenis}}/editable/{{$lam->nama_dokumen}}" download><button class="btn btn-info">Download</button></a>
																		</td>
																	</tr>
																	@endforeach
																	</tbody>
																</table>
															</div>
														</div>
														
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														</div>
													</div>
												</div>
											</div>
								</td>
								<?php		
								if($dl1 != 0){
								$udl=DB::table('user_review_catatan_revisisi')->where([['user_review',Auth::user()->id],['id_notif_catatan_review',$dl->id],])->count();
								
								?>
							
								
								
								@if($udl !=0 or $jenis_laporan->id_tujuan == Auth::user()->id or Auth::user()->hak_akses == "admin")
								<td width="10">
											<form style="display:none;" id="form_selesai_review" target="_blank" action="<?php echo url('/selesai_review'); ?>" method="post">
													<input type="hidden" id="token_revisi" name="_token" value="{{csrf_token()}}">
													<textarea name="file" id="simpan_gambar"></textarea>
													<textarea name="nama_gambar" id="nama_gambar"></textarea>
													@if($dl1 > 0)
													<input type="text" name="id_notif_catatan_review" value="{{$dl->id}}">
													@endif
													<input type="text" name="user_review" value="{{Auth::user()->id}}">
													<input type="text" name="id_dokumen_laporan_bulanan" value="{{$id}}">
													<input type="text" name="id_user" value="{{Auth::user()->id}}">
													
													<button type="submit" style="" class="btn btn-primary">save</button></a>
										</form>
										
											<a href="javascript:" data-toggle="modal" data-target="#largeModal"><i class="material-icons">error</i></a>
											<div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title" id="largeModalLabel">Daftar Revisi</h4>
														</div>
														<div class="modal-body">
															
															<div class="card-body ">
															
															  <div class="table-responsive" style="margin:10px;">
																
																
																<button type="submit" class="btn btn-info" data-toggle="modal" data-target="#smallModal">Tambah</button></a>
											
																
																<br>
																
																<table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%" cellspacing="0">
																  <thead>
																	<tr>
																	<th>Pe-Review</th>
																	<th>Hasil Review</th>
																	<th>Option</th>
																	  
																	</tr>
																  </thead>
																  
																  <tbody id="tampil_revisi_tabel">
																  
																  </tbody>
																  
																	<script>
																		function newtab(revisi_id, revisi_user){
																		var x = window.open('{{url('/lihat_revisi')}}?id_laporan_bulanan={{$id_laporan_bulanan}}&id_jenis_laporan={{$id_jenis_laporan}}&id_wilayah_operasi={{$id_wilayah_operasi}}&id_revisi=' + revisi_id + '&id_dokumen_laporan_bulanan={{$id}}&user=' + revisi_user,'_blank');
																			x.focus();
																		}
																	</script>
																</table>
															  </div>
															  
															  
															</div>
															
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
															<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
														</div>
													</div>
												</div>
											</div>
											
										</td>
							@endif
										
								@if(($dl->status == "Melaporkan" and $udl > 0 ) or ($dl->status == "Revisi" and $udl > 0 ) or (Auth::user()->hak_akses == "admin"))
										<td width="10">
										<a style="" href="javascript:" data-toggle="modal" data-target="#lihat_revisi_bulanan2"> <i class="material-icons">nature</i></a>
											<div class="modal fade" id="lihat_revisi_bulanan2" tabindex="-1" role="dialog">
												<div class="modal-dialog modal-sm" role="document">
													<div class="modal-content">
														
														<div class="modal-body">
															<form style="" target="_blank" action="<?php echo url('/lihat_dokumen_bulanan2'); ?>" method="post">
																<input type="hidden" name="_token" value="{{csrf_token()}}">
																<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
																<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
																<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
																<input type="hidden" name="id" value="{{$id}}">
																<div class="form-group">
																	<label for="exampleInputPassword1">Halaman</label>
																	<input type="number" class="" name="halaman">
																</div>
																<button type="submit" class="btn btn-primary">OK</button></a>
																<button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
															</form>
														</div>
														<div class="modal-footer">
															
														</div>
													</div>
												</div>
											</div>
										</td>
										
										<td width="10">
										<form style="display:none;" id="form_selesai_review" target="_blank" action="<?php echo url('/selesai_review'); ?>" method="post">
													<input type="hidden" id="token_revisi" name="_token" value="{{csrf_token()}}">
													<textarea name="file" id="simpan_gambar"></textarea>
													<textarea name="nama_gambar" id="nama_gambar"></textarea>
													@if($dl1 > 0)
													<input type="text" name="id_notif_catatan_review" value="{{$dl->id}}">
													@endif
													<input type="text" name="user_review" value="{{Auth::user()->id}}">
													<input type="text" name="id_dokumen_laporan_bulanan" value="{{$id}}">
													<input type="text" name="id_user" value="{{Auth::user()->id}}">
													
													<button type="submit" style="" class="btn btn-primary">save</button></a>
										</form>
										
											<a style="" id="selesai_review" href="javascript:" onclick="selesai_review();"> <i class="material-icons">done</i></a>
											
										</td>
										
										@endif
										<?php } ?>
										
									</tr>
								</table>
								
							</div>	
				
			</div>
		</div>
		
		<div class="modal fade" id="smallModal" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="smallModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						<form style="" id="tambah_revisi_hard" target="_blank" action="<?php echo url('/tambah_revisi_hard'); ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
							<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
							<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
							<input type="hidden" name="id" value="{{$id}}">
							<input type="hidden" name="input" value="2">
							<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
							<div class="form-group">
								<label for="exampleInputPassword1">File</label>
								<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
							</div>
							<button style="display:none;" type="submit"  class="btn btn-info">Save</button>
							
						</form>
						<a href="javascript:" onclick="revisi_hard();" class="waves-effect">
								<button class="btn btn-info">Save</button>
						</a>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
					</div>
				</div>
			</div>
		</div>
		
		<?php
		$t=URL::to('/')."/laporan_bulanan/".$folder->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$jenis_laporan->jenis."/". addslashes($dokumen_laporan_bulanan->nama_dokumen_laporan);
		
		?>
		<br>
		
		<iframe style="width:80%; margin-left:10%; height:100%;" src="<?php echo URL::to('/'); ?>/pdfjs/web/viewer.php?file={{$t}}"></iframe>
		
	</body>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/catatan/html2canvas.js"></script>
<script src="<?php echo URL::to('/'); ?>/catatan/canvas2image.js"></script>
<script src="<?php echo URL::to('/'); ?>/catatan/jquery-ui.js"></script>
<script src="<?php echo URL::to('/'); ?>/catatan/jquery-touch.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Base64/0.3.0/base64.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="<?php echo URL::to('/'); ?>/aset/js/pages/tables/jquery-datatable.js"></script>
<!-- Bootstrap Core Js -->
<script src="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap/js/bootstrap.js"></script>
<script>
function selesai_review(){
	document.getElementById('form_selesai_review').submit();
	window.setTimeout(refresh_selesai_review, 1000);
}

function refresh_selesai_review(){
	document.getElementById('backdbln').submit();
}

function revisi_hard() {
	document.getElementById('tambah_revisi_hard').submit();
	document.getElementById('lb').submit();
}

function hapus_revisi_pdf() {
	
	var token   = $('#token').val();
	var id_jenis_laporan   = {{$id_jenis_laporan}};
	var id_wilayah_operasi   = {{$id_wilayah_operasi}};
	var id_dokumen_laporan_bulanan   = {{$id}};
	var id_laporan_bulanan   = {{$id_laporan_bulanan}};
	var user   = {{Auth::user()->id}};
	
	 
	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : '<?php echo url("/hapus_revisi"); ?>',
		type     : 'POST',
		dataType : 'html',
		data     : "_token=" + token + "&id_jenis_laporan=" + id_jenis_laporan + "&id_wilayah_operasi=" + id_wilayah_operasi + "&id_laporan_bulanan=" + id_laporan_bulanan + "&id=" + id_dokumen_laporan_bulanan + "&user=" + user,
		success  : function(respons){
			document.getElementById('lb').submit();
			
		},
	});
	
}


function ambil_data_revisi(){
	var token_tabel_revisi   = $('#token_revisi').val();
				var id_laporan_bulanan   = {{$id_laporan_bulanan}};
				var id_jenis_laporan   = {{$id_jenis_laporan}};
				var id_wilayah_operasi   = {{$id_wilayah_operasi}};
				var id_dokumen_laporan_bulanan   = {{$id}};
				var user = {{Auth::user()->id}};
				$.ajax({
					//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
					url	     : '<?php echo url("/tampil_revisi_tabel"); ?>',
					type     : 'POST',
					data     : "_token=" + token_tabel_revisi + "&id_laporan_bulanan=" + id_laporan_bulanan + "&id_jenis_laporan=" + id_jenis_laporan + "&id_wilayah_operasi=" + id_wilayah_operasi + "&id=" + id_dokumen_laporan_bulanan + "&user=" + user,
					success  : function(respons2){
						document.getElementById("tampil_revisi_tabel").innerHTML = respons2;
						}
						
				});
}


ambil_data_revisi();

</script>