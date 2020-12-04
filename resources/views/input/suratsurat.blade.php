@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="{{ route('suratsurat.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Nomor Surat</label>
					<input type="text" name="no_surat" class="form-control ">
					
				</div>
				
				<div class="form-group">
					<label for="judul">Perihal</label>
					<input type="text" name="perihal" class="form-control ">
					
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					
				</div>
				<div class="form-group">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="arsip" class="form-control"  required="required">
				</div>								
				
				<div class="form-group">					
				<label for="isi">Jenis Surat</label>					
					<select name="jenis_surat" class="form-control"  required="required">
					<option>--Pilih--</option>						
					<option value="Surat Keluar">Surat Keluar</option>
					<option value="Surat Masuk">Surat Masuk</option>	
					</select>				
				</div>
				
				<div class="form-group">
					<label for="isi">File</label>
					<input type="file" id="file" name="file" class="form-control" onchange="validasiFile()" required="required">
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection
<script>
function validasiFile(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi mp4');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}


</script>