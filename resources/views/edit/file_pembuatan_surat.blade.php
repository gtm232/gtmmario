@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<form class="form-group" action="<?php echo url('/edit_file_pembuatan_surat_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				@if(Auth::user()->hak_akses == "admin")
				<div class="form-group">
					<label for="isi">Perihal</label>
					<input type="text" name="perihal" class="form-control" value="{{$edit_file_pembuatan_surat->perihal}}" required="required">
					<input type="hidden" name="id" class="form-control" value="{{$edit_file_pembuatan_surat->id}}">
					<input type="hidden" name="id_pembuatan_surat" class="form-control" value="{{$id_pembuatan_surat}}">
				</div>
				@endif
				
				@if(Auth::user()->hak_akses == "user")
				<div class="form-group">
					<input type="hidden" name="perihal" class="form-control" value="{{$edit_file_pembuatan_surat->perihal}}" required="required">
					<input type="hidden" name="id" class="form-control" value="{{$edit_file_pembuatan_surat->id}}">
					<input type="hidden" name="id_pembuatan_surat" class="form-control" value="{{$id_pembuatan_surat}}">
					<input style="display:none;" type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
					<input type="hidden" class="form-control" name="file_old" value="{{$edit_file_pembuatan_surat->nama_file}}" >
				</div>
				@endif
				
				@if(Auth::user()->hak_akses == "admin")
				<div class="form-group">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
					<input type="hidden" class="form-control" name="file_old" value="{{$edit_file_pembuatan_surat->nama_file}}" >
				</div>
				@endif
				
				<div class="form-group">
					<label for="isi">Catatan</label>
					<textarea name="catatan" id="catatan">
						{{$edit_file_pembuatan_surat->catatan}}
					</textarea>
					<script>
					CKEDITOR.replace('catatan', {removePlugins: 'about,sourcearea,link,elementspath,image'});
					</script>
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