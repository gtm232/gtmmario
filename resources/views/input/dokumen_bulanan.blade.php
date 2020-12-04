@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form id="tambah_dokumen_form" class="form-group" action="<?php echo url('/tambah_dokumen_bulanan_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-group">
					<label for="isi">Perihal</label>
					<input type="text" name="prihal" class="form-control" required="required">
					<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
					<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
					<input type="hidden" name="id_users" value="{{Auth::user()->id}}">
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
				</div>
				
				<div class="form-group">
					<label class="col-sm-4 control-label">Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
				</div>
				
				<div  class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
	<!--<button id="button_save" onclick="simpan_dokumen_laporan_bulanan();" type="submit" class="btn btn-primary">Simpan</button></a>
	
	<form id="back_dbln" action="<?php echo url('/dokumen_bulanan'); ?>" method="post">
						<in                put type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<button style="display:none;" type="submit" class="btn btn-primary">save</button></a>
	
	</form> 
	
	style="<?php if(Auth::user()->hak_akses != 'admin'){ echo 'display:none;'; }?>" -->
	
@endsection

<script>


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


</script>