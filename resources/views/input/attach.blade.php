@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Attach</h2>
			<form class="form-group" action="<?php echo url('/attach_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file"  id="file" required>
					<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
					<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
					<input type="hidden" name="id" value="{{$id}}">
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection

