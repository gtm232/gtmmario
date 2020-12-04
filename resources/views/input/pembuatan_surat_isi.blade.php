@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/tambah_pembuatan_surat_isi_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Nama File</label>
					<input type="text" name="nama_file" class="form-control" required="required">
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}" class="form-control" >
				</div>
				
				<div class="form-group">
					<label for="isi">Isi</label>
					<textarea name="isi" id="catatan">
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