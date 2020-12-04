@extends('base.app')
@section('content')

	<div class="row">
	<h2 align="center">Tambah Data</h2><br>
		<div class="col-md-12">
			<!-- content -->
			
			<form class="form-line" action="{{ route('perencanaan.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-line">
					<label for="isi">Nama Pekerjaan</label>
					<input type="text" name="nama_pekerjaan" class="form-control" required="required">
				</div>
				
				<div class="form-line">
					<label for="isi">Estimasi</label>
					<br>
					<select name="bulan" required="required">
						<option value="">--Pilih--</option> 
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
					
					<label for="isi" style="margin:0px 10px 0px 10px;">Sampai</label>
					
					<select name="sampai_bulan" required="required">
						<option value="">--Pilih--</option> 
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
					
					
				</div>
			
			<div class="form-line">
					<label for="isi">Tahun</label>
					<input type="number" name="tahun" class="form-control" required="required">
			</div>
			
			<br>
			<div class="form-line">
				<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
			</div>
		</form>
	</div>
	</div>
	
@endsection