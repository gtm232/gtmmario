@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Menu Add Data</h2>
			<form class="form-group" action="{{ route('suratsurat.update',$suratsurat->id) }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Nomor Surat</label>
					<input type="text" name="no_surat" class="form-control " value="{{$suratsurat->no_surat}}" required>
					
				</div>
				
				<div class="form-group">
					<label for="judul">Perihal</label>
					<input type="text" name="perihal" class="form-control " value="{{$suratsurat->perihal}}" required>
					
				</div>
				<div class="form-group">
					<label class="col-sm-4 control-label">Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime ($suratsurat->tanggal)) ; ?>" readonly>
					
				</div>
				<div class="form-group">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="arsip" class="form-control" value="{{$suratsurat->lokasi}}" required="required">
				</div>
				
				<div class="form-group">
					<label for="isi">File</label>
					<input type="file" id="file" name="file2" class="form-control" onchange="validasiFile()">
					<input type="hidden" name="file_old" class="form-control" value="{{$suratsurat->file}}">
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