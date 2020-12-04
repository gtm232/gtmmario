@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Menu Add Data</h2>
			<form class="form-group" action="{{ route('acrue.update',$acrue->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label >Tanggal Mulai</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_mulai" value="<?php echo date('d F Y',strtotime ($acrue->tanggal_mulai)) ; ?>" readonly>
					  <input type="hidden" name="tahun" value="{{$acrue->tahun}}">
				</div>
				
				<div class="form-group">
					<label >Tanggal Berakhir</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="tanggal_berakhir" value="<?php echo date('d F Y',strtotime ($acrue->tanggal_akhir)) ; ?>" readonly>
					
				</div>
				
				
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection