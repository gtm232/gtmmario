@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/tambah_wilayah_operasi_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-group">
					<label for="isi">Wilayah Operasi</label>
					<input type="text" name="wilayah_operasi" class="form-control" required="required">
					<input type="hidden" name="id_laporan_bulanan" class="form-control" value="{{$id_laporan_bulanan}}">
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection