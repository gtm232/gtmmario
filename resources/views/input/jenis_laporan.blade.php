@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/tambah_jenis_laporan_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-group">
					<label for="isi">Jenis Laporan</label>
					<input type="text" name="jenis_laporan" class="form-control" required="required">
					<input type="hidden" name="id_laporan_bulanan" class="form-control" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_wilayah_operasi" class="form-control" value="{{$id_wilayah_operasi}}">
				</div>
				
				<div class="form-group">
					<label for="isi">Pelapor</label>
						<select name="pelapor" class="form-control" required="required">
							<option value="">--Pilih Pelapor--</option>
							<option value="0">Tidak Ada Pelapor</option>
							<?php
							$pelapor=DB::table('users')->get();
							?>
							@foreach($pelapor as $pelapor)
								<option value="{{$pelapor->id}}">{{$pelapor->name}}</option>
								
							@endforeach
						</select>
				</div>
				
				
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection