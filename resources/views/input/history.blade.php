@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/tambah_history_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<input type="hidden" name="id_laporan_pekerjaan" class="form-control" value="{{$id_laporan_pekerjaan}}">
				<input type="hidden" name="id_pembuatan_surat" class="form-control" value="{{$id_pembuatan_surat}}">
				<input type="hidden" name="akses" class="form-control" value="admin">
				
				<div class="form-line">
					<label for="exampleInputPassword1">Penerima</label>
					<select class="form-control" name="pic" id="file" required>
					<?php
					$users=DB::table('users')->get();
					?>
						<option value="">--Pilih PIC--</option>
						@foreach($users as $users)
							<option value="{{$users->id}}">{{$users->name}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-line">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" required>
				</div>
				
				<br>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
	
@endsection
