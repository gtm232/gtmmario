@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="{{ route('acrue.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label >Tanggal Mulai</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_mulai" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					  <input type="hidden" name="tahun" value="{{date('Y')}}">
				</div>
				
				<div class="form-group">
					<label >Tanggal Berakhir</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="tanggal_berakhir" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection