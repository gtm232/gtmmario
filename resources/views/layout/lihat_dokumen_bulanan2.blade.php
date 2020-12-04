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
	<style>
		
				
		#the-canvas {
		  border: 1px solid black;
		  direction: ltr;
		  width:60%;
		  margin-left:20%;
		  z-index:1;
		   
		}
	</style>
	
	</head>
	
	<body>
	
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
		
		<div style="width:100%;">
			<div style="margin: 0 auto;">			   
							<?php $dokumen_laporan_bulanan2=DB::table('dokumen_laporan_bulanan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['jenis_laporan',$id_jenis_laporan],['wilayah_operasi',$id_wilayah_operasi],])->get(); ?>
							<div class="card-body ">
								<?php
								$dl=DB::table('notif_catatan_revisi')->where('id_dokumen_laporan',$dokumen_laporan_bulanan->id)->get()->first();
								$dl1=DB::table('notif_catatan_revisi')->where('id_dokumen_laporan',$dokumen_laporan_bulanan->id)->count();
								?>
								
								<table border="0" style="margin:0 auto;">
									<tr>
								
								<?php		
								if($dl1 != 0){
								$udl=DB::table('user_review_catatan_revisisi')->where([['user_review',Auth::user()->id],['id_notif_catatan_review',$dl->id],])->count();
								
								?>
								@if(($dl->status == "Melaporkan" and $udl > 0 ) or (Auth::user()->hak_akses == "admin"))
									
										
										<td>
											<form method="post" name="frm_ajax" style="">
												<input id="no_garis" type="hidden" value="1" class="form-control">
												<input type="hidden" name="_token" id="token_garis" value="{{ csrf_token() }}">
											</form>
											<a style="" href="javascript:" onclick="kirim_garis();"> <i class="material-icons">remove</i></a>
											
										</td>
										
										<td>
											<a href="javascript:" type="button" data-toggle="modal" data-target="#review">
												<i class="material-icons">format_shapes</i>
											</a>
										
											<div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Silahkan isi Form</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
												  </div>
												  <div class="modal-body">
													<form method="post" name="frm_ajax" style="">
														<input id="no_catatan" type="hidden" value="1" class="form-control">
														<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
														<textarea style="width:100%; height:100px;" name="isi" id="isi"></textarea>
														<input style="margin-top:10px; width:50px; background:blue; color:white;" class="form-control" type="button" onclick="kirim_form();" value="OK"/>
													</form>
												  </div>
												 
												</div>
											  </div>
											</div>
											
										</td>
										
										<td>
											<form style="display:none;" id="form_simpan_gambar" target="_blank" action="<?php echo url('/save_revisi'); ?>" method="post">
													<input type="hidden" id="token_revisi" name="_token" value="{{csrf_token()}}">
													<textarea name="file" id="simpan_gambar"></textarea>
													<textarea name="nama_gambar" id="nama_gambar"></textarea>
													<input type="text" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
													<input type="text" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
													<input type="text" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
													<input type="text" name="id" value="{{$id}}">
													<input type="text" name="id_user" value="{{Auth::user()->id}}">
													<input type="text" id="param" name="param" value="">
													<button type="submit" style="" class="btn btn-primary">save</button></a>
											</form>
											<a style="" id="save_revisi" href="javascript:" onclick="save_revisi();"> <i class="material-icons">save</i></a>
											
										</td>
										
										<td>
										<a style="" id="button" href="javascript:"> <i class="material-icons">rotate_right</i></a>
										<input id="derajat" type="hidden" value="0">
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
		<div id="holder">
			<div id="pesan_kirim" style="max-height:0px; width:100%; position:absolute; z-index:2;"></div>
			<canvas id="the-canvas"></canvas>
		</div>
		<input type="hidden" id="scale" value="1">
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
<script src="<?php echo URL::to('/'); ?>/pdfjs/build/pdf.js"></script>	
<!-- Bootstrap Core Js -->
<script src="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap/js/bootstrap.js"></script>
<script>
function save_revisi(){
	$("#loading").show();
	html2canvas($("#holder"), {
            onrendered: function(canvas) {
				
                theCanvas = canvas;
                //document.body.appendChild(canvas);
			
                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                var image = Canvas2Image.convertToPNG(canvas);
               var image_data = $(image).attr('src');
               //$('#img').append(image_data);
			   //document.getElementById('gambar_c').value =image_data;
			   //document.getElementById('revisi').submit();
              //make an ajax call here sending image_data to the server
              /*
              $.ajax({
              url: 'localhost:3000/save_image',
              data:{ image: image_data},
              success: function(){
              
              }
              });
              */
                //$("#img-out").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
				
				var token_revisi   = $('#token_revisi').val();
				var halaman   = $('#halaman').val();
				var id_laporan_bulanan   = {{$id_laporan_bulanan}};
				var id_jenis_laporan   = {{$id_jenis_laporan}};
				var id_wilayah_operasi   = {{$id_wilayah_operasi}};
				var id_dokumen_laporan_bulanan   = {{$id}};
				var user  = {{Auth::user()->id}};
				var gambar  = image_data;
				var d = new Date();
				var n = d.getTime();
				var nama_gambar  = n +".png";
				var input = 1;
				
				$.ajax({
					//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
					url	     : '<?php echo url("/save_revisi_data"); ?>',
					type     : 'POST',
					data     : "_token=" + token_revisi + "&id_laporan_bulanan=" + id_laporan_bulanan + "&id_jenis_laporan=" + id_jenis_laporan + "&id_wilayah_operasi=" + id_wilayah_operasi + "&id_dokumen_laporan_bulanan=" + id_dokumen_laporan_bulanan + "&user=" + user + "&nama_gambar=" + nama_gambar + "&halaman=" + halaman + "&input=" + input,
					success  : function(respons){
						document.getElementById('simpan_gambar').value =gambar;
						document.getElementById('nama_gambar').value =nama_gambar;
						document.getElementById('param').value =respons;
						document.getElementById("form_simpan_gambar").submit();
						$("#loading").hide();
						var div = document.getElementById('pesan_kirim');
						while(div.firstChild){
							div.removeChild(div.firstChild);
						}
						alert(respons);
						ambil_data_revisi();
					},
				});
				
				
				
				
            }
        });
		
	
};

function kirim_garis(){
	
	var no_garis  = $('#no_garis').val();
	var token_garis   = $('#token_garis').val();
	
	
	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : '<?php echo url("/garis"); ?>',
		type     : 'POST',
		dataType : 'html',
		data     : 'no_garis='+no_garis+ "&_token=" + token_garis,
		success  : function(respons){
			$('#pesan_kirim').append(respons);
			$('#pesan_kirim').slideDown('fast');
			document.getElementById('no_garis').value = parseInt(no_garis)+1;
			
			
		},
	});
};

function kirim_form(){
	var no   = $('#no_catatan').val();
	var isi   = $('#isi').val();
	var token   = $('#token').val();
	
	 
	$.ajax({
		//Alamat url harap disesuaikan dengan lokasi script pada komputer anda
		url	     : '<?php echo url("/catatan"); ?>',
		type     : 'POST',
		dataType : 'html',
		data     : 'no='+no+ "&_token=" + token+ "&isi=" + isi,
		success  : function(respons){
			$('#pesan_kirim').append(respons);
			$('#pesan_kirim').slideDown('fast');
			document.getElementById('no_catatan').value = parseInt(no)+1;
			
			
		},
	});
};


var rotated = false;

document.getElementById('button').onclick = function() {
	var derajat   = parseInt($('#derajat').val())+parseInt(90);
	if(derajat > 360){
		var derajat = parseInt(90);
	}
	
    var div = document.getElementById('the-canvas'),
        deg = rotated ? 0 : derajat;

    div.style.webkitTransform = 'rotate('+deg+'deg)'; 
    div.style.mozTransform    = 'rotate('+deg+'deg)'; 
    div.style.msTransform     = 'rotate('+deg+'deg)'; 
    div.style.oTransform      = 'rotate('+deg+'deg)'; 
    div.style.transform       = 'rotate('+deg+'deg)'; 
	

    
	
	document.getElementById('derajat').value =derajat;
}

var url = '{{$t}}';

// Loaded via <script> tag, create shortcut to access PDF.js exports.
var pdfjsLib = window['pdfjs-dist/build/pdf'];

// The workerSrc property shall be specified.
pdfjsLib.GlobalWorkerOptions.workerSrc = '{{URL::to("/")}}/pdfjs/build/pdf.worker.js';

// Asynchronous download of PDF
var loadingTask = pdfjsLib.getDocument(url);
loadingTask.promise.then(function(pdf) {
  console.log('PDF loaded');
  
  // Fetch the first page
  var pageNumber = {{$halaman}};
  pdf.getPage(pageNumber).then(function(page) {
    console.log('Page loaded');
    
    var scale = 5;
    var viewport = page.getViewport({scale: scale});

    // Prepare canvas using PDF page dimensions
    var canvas = document.getElementById('the-canvas');
    var context = canvas.getContext('2d');
    canvas.height = viewport.height;
    canvas.width = viewport.width;

    // Render PDF page into canvas context
    var renderContext = {
      canvasContext: context,
      viewport: viewport
    };
    var renderTask = page.render(renderContext);
    renderTask.promise.then(function () {
      console.log('Page rendered');
    });
  });
}, function (reason) {
  // PDF loading error
  console.error(reason);
});


</script>