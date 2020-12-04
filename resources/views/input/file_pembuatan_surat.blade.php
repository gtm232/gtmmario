@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/tambah_file_pembuatan_surat_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="isi">Perihal</label>
					<input type="text" name="perihal" class="form-control" required="required">
					<input type="hidden" name="id_pembuatan_surat" class="form-control" value="{{$id_pembuatan_surat}}">
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
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
    var ekstensiOk = /(\.pdf|\.PDF|\.jpg|\.JPG|\.jpeg|\.JPEG|\.png|\.PNG|\.doc)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi JPG,JPEG,PNG,dan PDF');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}


</script>