@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<?php
			$pembuatan_surat_isi=DB::table('pembuatan_surat_isi')->where('id','=',$id_edit)->get()->first();
			?>
			<form class="form-group" action="<?php echo url('/edit_pembuatan_surat_isi_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Nama File</label>
					<input type="text" name="nama_file" class="form-control" value="{{$pembuatan_surat_isi->prihal}}" required="required">
					<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}" class="form-control" >
					<input type="hidden" name="id" value="{{$pembuatan_surat_isi->id}}" class="form-control" >
				</div>
				
				<div class="form-group">
					<label for="isi">Isi</label>
					<textarea name="isi" id="catatan">{{$pembuatan_surat_isi->isi}}
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