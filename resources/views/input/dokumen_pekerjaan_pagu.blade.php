@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/tambah_dokumen_pekerjaan_proses_pagu'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-line">
					<label for="isi">No Surat</label>
					<input type="text" name="no_surat" class="form-control" value="<?php if(isset($no_surat)){echo $no_surat->nomor_surat;} ?>" required="required">
					<input type="hidden" name="id_laporan_pekerjaan" class="form-control" value="{{$id_laporan_pekerjaan}}">
				</div>
				
				<?php
				$parameter_BANK=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','Undangan Nego'],])->count();
				$parameter_SPK=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BA Nego'],])->count();
				$parameter_LPS=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK'],])->count();
				$parameter_BAP=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','LPS'],])->count();
				$parameter_BAST=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAP'],])->count();
				$parameter_SPP=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAST'],])->count();
				?>
				<div class="form-line">
					<label for="isi">Jenis Dokumen</label>
					<select name="jenis_dokumen" class="form-control" id="zoneSelect" onchange="updateChar();" required="required">
						<option value="">--Pilih Jenis Dokumen--</option>
						<option value="Usulan">Usulan</option>
						<option value="SPPH">Surat Permintaan Penawaran Harga</option>
						<option value="SPH">Surat Penawaran Harga</option>
						<option value="Undangan Nego">Undangan Klarifikasi & Negosiasi</option>
						
						<option value="BA Nego">Berita Acara Hasil Klarifikasi & Negosiasi</option>
						
						<?php if($parameter_SPK != 0){ ?>
						<option value="SPK">Surat Perintah Kerja</option>
						<?php } ?>
						<?php if($parameter_LPS != 0){ ?>
						<option value="LPS">Laporan Penyelesaian Pekerjaan</option>
						<?php } ?>
						<?php if($parameter_BAP != 0){ ?>
						<option value="BAP">Berita Acara Pemeriksaan</option>
						<?php } ?>
						<?php if($parameter_BAST != 0 or $parameter_BAP != 0){ ?>
						<option value="BAST">Berita Acara Serah Terima</option>
						<?php } ?>
						<?php if($parameter_SPP != 0 or $parameter_BAST != 0 or $parameter_SPK != 0){ ?>
						<option value="SPP">Surat Permohonan Pembayaran</option>
						<?php } ?>
						<option value="Surat Masuk">Surat Masuk</option>
						<option value="Surat Keluar">Surat Keluar</option>
					</select>
				</div>
				
				<?php
					$perihal=DB::table('laporan_pekerjaan_pagu')->where('id','=',$id_laporan_pekerjaan)->get()->first();
				?>
				<div class="form-line">
					<label for="isi">Perihal</label>
					<input type="text" id="prihal" name="nama" class="form-control" required="required">
				</div>
				
				<div class="form-line">
					<label >Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl3" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
				</div>
				
				<div style="display:none;" id="harga1" class="form-line">
					<label for="judul">Harga</label>
					<input type="text" id="harga_kesepakatan" name="harga" class="form-control" >
				</div>
				
				<div style="display:none;" id="durasi" class="form-line">
					<label for="judul">Durasi</label>
					<input type="number" id="durasi" name="durasi" value="0" class="form-control" >
				</div>
				
				<div style="display:none;" id="perpem" class="form-line">
					<label for="judul">Persentasi Pembayaran</label>
					<select id="p2" name="p2" onchange="perPem();" class="form-control" >
					<?php
					$parm=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK'],])->get()->first();
					$parm3=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPK'],])->count();
					if($parm3!=0){
					$parm2=DB::table('spk_dev_pagu')->where('id_dokumen',$parm->id)->get();
					}
					?>
					<option value="">--Pilih--</option>
					<?php
					if($parm3!=0){
					?>
					@foreach($parm2 as $parm2)
					<option value="{{$parm2->id}}">{{$parm2->persentasi}} %</option>
					@endforeach
					<?php
					}
					?>
					</select>
					
					<input type="hidden" name="persentasi_pembayaran" id="persentasi_pembayaran">
					
				</div>
				
				<div class="form-line">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" required>
				</div>
				
				<br>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection

<script>
function updateChar() {
	
    var zone = document.getElementById("zoneSelect");

    if (zone.value == "SPK"){
		$("#harga1").fadeIn(1000);
		$("#durasi").fadeIn(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("prihal").value = "Surat Perintah Kerja {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
    }else if (zone.value == "SPP"){
		$("#durasi").fadeOut(1000);
		$("#harga1").fadeIn(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("prihal").value = "Surat Permohonan Pembayaran {{$perihal->nama_pekerjaan}}";
		document.getElementById("durasi").value = 0;
		document.getElementById("persentasi_pembayaran").value = 0;
    }else if (zone.value == "SPH"){
		$("#harga1").fadeIn(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("prihal").value = "Surat Penawaran Harga {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
    }else if (zone.value == "Usulan"){
		$("#harga1").fadeIn(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("prihal").value = "Usulan {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
	}else if (zone.value == "SPPH"){
		$("#harga1").fadeOut(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("harga_kesepakatan").value = "Rp 0";
		document.getElementById("prihal").value = "Surat Permintaan Penawaran Harga {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
	}else if (zone.value == "Undangan Nego"){
		$("#harga1").fadeOut(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("prihal").value = "Undangan Klarifikasi dan Negosiasi {{$perihal->nama_pekerjaan}}";
		document.getElementById("harga_kesepakatan").value = "Rp 0";
		document.getElementById("persentasi_pembayaran").value = 0;
	}else if (zone.value == "BA Nego"){
		$("#harga1").fadeOut(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("harga_kesepakatan").value = "Rp 0";
		document.getElementById("prihal").value = "Berita Acara Klarifikasi dan Negosiasi Harga {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
	}else if (zone.value == "LPS"){
		$("#harga1").fadeOut(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeIn(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("harga_kesepakatan").value = "Rp 0";
		document.getElementById("prihal").value = "Laporan Penyelesaian {{$perihal->nama_pekerjaan}}";
	}else if (zone.value == "BAP"){
		$("#harga1").fadeIn(1000);
		$("#durasi").fadeOut(1000);
		$("#perpem").fadeIn(1000);
		document.getElementById("durasi").value = 0;
		document.getElementById("prihal").value = "Berita Acara Pemeriksaan {{$perihal->nama_pekerjaan}}";
	}else if (zone.value == "BAST"){
		$("#harga1").fadeIn(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("prihal").value = "Berita Acara Serah Terima {{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
	}else if (zone.value == "Surat Masuk" || zone.value == "Surat Keluar"){
		$("#harga1").fadeIn(1000);
		$("#perpem").fadeOut(1000);
		document.getElementById("prihal").value = "{{$perihal->nama_pekerjaan}}";
		document.getElementById("persentasi_pembayaran").value = 0;
	}
}

function validasiFile(){
	
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi PDF');
        inputFile.value = '';
        return false;
    }else{
        var file_size = $('#file')[0].files[0].size;
	 if(file_size>32000000) {
	  alert('File maksimal 30 mb, Silahkan Potong Jadi Beberapa Bagian');
	  inputFile.value = '';
	  return false;
	 } 
        
    }
}

function perPem() {
var pp = document.getElementById("p2");
		document.getElementById("persentasi_pembayaran").value = pp.value;
}

</script>

