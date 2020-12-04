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
<?php
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
 
$edit_pbs=DB::table('pembuatan_surat')->where('id',$id_pembuatan_surat)->get()->first();
$jd=$edit_pbs->jenis_dokumen;
	
	?>
	<div class="row">
		<div class="col-md-12">
		<?php
		if($jd == "Undangan"){
		?>
				<!-- content -->
				<h2>Tambah Data</h2>
				<form class="form-line" action="<?php echo url('/selesai_revisi_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}">	
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" value="{{$edit_pbs->nomor_surat}}" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Sifat</label>					
						<input type="text" name="sifat" class="form-control" value="{{$edit_pbs->sifat}}" required="required">				
					</div>			
					
					<div class="form-line">					
						<label for="judul">Lampiran</label>					
						<input type="text" name="lampiran" class="form-control" value="{{$edit_pbs->lampiran}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label for="judul">Perihal</label>															
						<input type="text" name="perihal" class="form-control" value="{{$edit_pbs->perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($edit_pbs->tanggal_surat)) ; ?>" readonly>									
					</div>								
					
					<div class="form-line">					
						<label for="judul">Tujuan</label>					
							<input type="text" name="tujuan" class="form-control" value="{{$edit_pbs->tujuan}}" required="required">				
					</div>
						
						<div class="form-line">
							<label for="judul">Alamat</label>
							<input type="text" name="alamat" class="form-control" value="{{$edit_pbs->alamat}}" required="required">				
						</div>								
					
					<div class="form-line">					
									
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">					
						<?php
							echo $edit_pbs->isi;
						?>
					</textarea>					
					<script>					
					CKEDITOR.replace('catatan', {removePlugins: 'about,link,elementspath'});					
					</script>				
					</div>								
					<button type="submit" class="btn btn-info">Tambah</button>		
				</form>
		<?php
		}else if($jd == "BA Nego"){
		?>
				<form class="form-line" action="<?php echo url('/selesai_revisi_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">						
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" value="{{$edit_pbs->nomor_surat}}" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>															
						<input type="text" name="perihal" class="form-control" value="{{$edit_pbs->perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($edit_pbs->tanggal_surat)) ; ?>" readonly>									
					</div>								
					
					
					<div class="form-line">					
					
					<textarea name="namapic" id="catatan2">
						<?php
							echo $edit_pbs->namapic;
						?>
					</textarea>
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					<?php
							echo $edit_pbs->isi;
						?>
					
					</textarea>					
									
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}else if($jd == "SPK"){
		?>
					<h2>Tambah Data</h2>
				<form class="form-line" action="<?php echo url('/selesai_revisi_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" value="{{$edit_pbs->nomor_surat}}" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Sifat</label>					
						<input type="text" name="sifat" class="form-control" value="{{$edit_pbs->sifat}}" required="required">				
					</div>			
					
					<div class="form-line">					
						<label for="judul">Lampiran</label>					
						<input type="text" name="lampiran" class="form-control" value="{{$edit_pbs->lampiran}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label for="judul">Perihal</label>
						<input style="background:#ffff;" type="hidden" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($edit_pbs->tanggal_surat)) ; ?>" readonly>						
										
						<input type="text" name="perihal" class="form-control" value="{{$edit_pbs->perihal}}" required="required">				
					</div>													
					
					<div class="form-line">					
						<label for="judul">Tujuan</label>					
							<input type="text" name="tujuan" class="form-control" value="{{$edit_pbs->tujuan}}" required="required">				
					</div>
						
					<div class="form-line">					

					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					 <?php
					  echo $edit_pbs->isi;
					 ?>
					</textarea>	
									
					</div>								
					<button type="submit" class="btn btn-info">Tambah</button>		
				</form>
		<?php
		}else if($jd == "BAP"){
		?>
					<form class="form-line" action="<?php echo url('/selesai_revisi_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" value="{{$edit_pbs->nomor_surat}}" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
										
						<input type="text" name="perihal" class="form-control" value="{{$edit_pbs->perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($edit_pbs->tanggal_surat)) ; ?>" readonly>									
					</div>
					
					<div class="form-line">					
					
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
						<?php
							echo $edit_pbs->isi;
						?>
					</textarea>					
									
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}else if($jd == "BAST"){
		?>
					<form class="form-line" action="<?php echo url('/selesai_revisi_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" value="{{$edit_pbs->nomor_surat}}" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
											
						<input type="text" name="perihal" class="form-control" value="{{$edit_pbs->perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($edit_pbs->tanggal_surat)) ; ?>" readonly>									
					</div>
					
					<div class="form-line">					
										
					<textarea name="namapic" id="catatan2">
					<?php
						echo $edit_pbs->namapic;
					?>
						
					</textarea>
					
					
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					<?php
						echo $edit_pbs->isi;
					?>
					</textarea>					
									 
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}
		?>
		</div>
	</div>
	
@endsection

