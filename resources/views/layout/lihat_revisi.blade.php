<html>

	<head>
	
	</head>
	
	<body>
	<?php
	$id_dokumen_laporan_bulanan=$_GET['id_dokumen_laporan_bulanan'];
	$user=$_GET['user'];
	$tr=DB::table('laporan_bulanan_revisi')->where([['id_dokumen_laporan_bulanan',$id_dokumen_laporan_bulanan],['user',$user],])->orderBy('input', 'ASC')->get();
	$tr2=DB::table('laporan_bulanan_revisi')->where([['id_dokumen_laporan_bulanan',$id_dokumen_laporan_bulanan],['user',$user],])->count();
	$tc=DB::table('notif_catatan_revisi')->where('id_dokumen_laporan',$id_dokumen_laporan_bulanan)->get()->first();
	
	$id_wilayah_operasi=$_GET["id_wilayah_operasi"];
	$id_jenis_laporan=$_GET["id_jenis_laporan"];
	
	if($tr2 >= 1){
		
	foreach($tr as $tr){
		
	$revisi=DB::table('laporan_bulanan_revisi')->where('id',$tr->id)->get()->first();
	$folder=DB::table('laporan_bulanan')->where('id',$tr->id_laporan_bulanan)->get()->first();
	$wilayah=DB::table('wilayah_operasi')->where('id',$_GET["id_wilayah_operasi"])->get()->first();
	$jenis_laporan=DB::table('jenis_laporan')->where('id',$_GET["id_jenis_laporan"])->get()->first();
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
	$id_revisi=$tr->id;
	$id_user=$tr->user;
	?>
	@if(($tc->status == "Melaporkan" and $revisi->user == Auth::user()->id) or (Auth::user()->hak_akses == "admin"))
		<form id="form_hapus{{$tr->id}}" target="_blank" method='post' style="display:none;" action='<?php echo url('/lihat_hapus_revisi')?>'>
			<input type='hidden' name='_token' value='{{csrf_token()}}'>
			<input type='hidden' name='id_laporan_bulanan' value='{{$tr->id_laporan_bulanan}}'>
			<input type='hidden' name='id_jenis_laporan' value='{{$id_jenis_laporan}}'>
			<input type='hidden' name='id_wilayah_operasi' value='{{$id_wilayah_operasi}}'>
			<input type='hidden' name='id' value='{{$id_dokumen_laporan_bulanan}}'>
			<input type='hidden' name='id_revisi' value='{{$tr->id}}'>
			<input style="background:red; color:yellow;" type='submit' class='btn btn-danger' value='Delete' />
		</form>
		
		<script>
		function hapus{{$tr->id}}(){
			document.getElementById('form_hapus{{$tr->id}}').submit();
			window.setTimeout(refresh_tampil, 2000);
		}
		</script>
		
		<button onclick="hapus{{$tr->id}}();" style="background:red; color:yellow;" class='btn btn-danger'>Hapus</button>
	@endif
		@if($tr->input == 1)
			
		<img style="display: block; margin-left: auto; margin-right: auto;" src="{{URL::to('/')}}/laporan_bulanan/{{$folder->tahun}}/{{$nama_bulan}}/{{$wilayah->wilayah_operasi}}/{{$jenis_laporan->jenis}}/revisi/{{$revisi->nama_gambar}}">
		
		@elseif($tr->input == 2)
		
		<?php
		$t=URL::to('/')."/laporan_bulanan/".$folder->tahun."/".$nama_bulan."/".$wilayah->wilayah_operasi."/".$jenis_laporan->jenis."/revisi/". addslashes($tr->nama_gambar);
		
		?>
		<div style="width:100%;">
			<div style="text-align:center;" id="holder"></div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.385/build/pdf.min.js"></script>
		<script>
		function renderPDF(url, canvasContainer, options) {
			
				options = options || { scale: 1.5 };
					
				function renderPage(page) {
					var viewport = page.getViewport(options.scale);
					var wrapper = document.createElement("div");
					wrapper.className = "canvas-wrapper";
					var canvas = document.createElement('canvas');
					var ctx = canvas.getContext('2d');
					var renderContext = {
					  canvasContext: ctx,
					  viewport: viewport
					};
					
					canvas.height = viewport.height;
					canvas.width = viewport.width;
					wrapper.appendChild(canvas);
					canvasContainer.appendChild(wrapper);
					
					page.render(renderContext);
				}
				
				function renderPages(pdfDoc) {
					for(var num = 1; num <= pdfDoc.numPages; num++){
						pdfDoc.getPage(num).then(renderPage);
					}
					
					
				}
				
				
				
				PDFJS.disableWorker = true;
				PDFJS.getDocument(url).then(renderPages);
				

			};

			renderPDF('{{$t}}', document.getElementById('holder'));
		</script>
		
		@endif
		<hr>
		
	<?php
	} 
	}else{ 
	$id_revisi=0;
	$id_user=0;
		echo "<script>javascript:self.close();</script>";
	}
	?>
	</body>
	
</html>

<script>

function refresh_tampil(){
		window.location.href="{{url('/lihat_revisi')}}?id_laporan_bulanan={{$_GET['id_laporan_bulanan']}}&id_jenis_laporan={{$id_jenis_laporan}}&id_wilayah_operasi={{$id_wilayah_operasi}}&id_revisi={{$id_revisi}}&id_dokumen_laporan_bulanan={{$id_dokumen_laporan_bulanan}}&user={{$id_user}}";

}

</script>