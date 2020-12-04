@extends('base.app')
@section('content')

	<div class="row">
	<h2 align="center">Tambah Data</h2><br>
		<div class="col-md-12">
			<!-- content -->
			
			<form class="form-line" action="{{ route('jenis_anggaran.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-line">
					<label for="isi">Jenis Anggaran</label>
					<input type="text" name="jenis_anggaran" class="form-control" required="required">
				</div>
			
			<br>
			<div class="form-line">
				<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			</div>
		</form>
	</div>
	</div>
	
@endsection

