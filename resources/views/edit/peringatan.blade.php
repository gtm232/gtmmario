@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Menu Add Data</h2>
			<form class="form-group" action="{{ route('peringatan.update',$peringatan->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="isi">Nama Pekerjaan</label>
					<input type="text" name="nama_pekerjaan" class="form-control" value="{{$peringatan->nama_pekerjaan}}" required="required">
				</div>
				
				<div class="form-group">
					<label >Tanggal Mulai</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_mulai" value="<?php echo date('d F Y',strtotime ($peringatan->tanggal_mulai)) ; ?>" readonly>
					
				</div>
				
				<div class="form-group">
					<label >Tanggal Berakhir</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="tanggal_berakhir" value="<?php echo date('d F Y',strtotime ($peringatan->tanggal_berakhir)) ; ?>" readonly>
					
				</div>
				
				
				<div class="form-group">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="lokasi" class="form-control" value="{{$peringatan->lokasi}}" required="required">
				</div>
				
				<div class="form-group">
					<label for="isi">PIC</label>
					<input type="text" name="pic" class="form-control" value="{{$peringatan->pic}}" required="required">
				</div>
				
				<div class="form-group">
					<label for="isi">Status</label>
					<select type="text" name="status" class="form-control"  required="required">
						<option value="OPEN">OPEN</option>
						<option value="CLOSED">CLOSED</option>
					</select>
				</div>
				
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection