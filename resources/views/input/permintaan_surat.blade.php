@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="{{ route('permintaan_surat.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label>Perihal Permintaan</label>
					  <input type="text" class="form-control" name="perihal_permintaan">
					
				</div>
				
				<div class="form-group">
					<label>File</label>
					  <input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection