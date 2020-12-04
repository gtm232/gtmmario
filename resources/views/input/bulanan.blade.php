@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="{{ route('bulanan.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Bulan</label>
					<select name="bulan" class="form-control ">
						<option value="">Pilih Bulan</option>
						
						
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
				<div class="form-group">
					<label for="headline">Tahun</label>
					<select name="tahun" class="form-control">
						<option value="">Pilih Tahun</option>
						<?php
						$thn_skr = date('Y');
						for ($x = $thn_skr; $x >= 2010; $x--) {
							
						?>
							<option value="<?php echo $x ?>"><?php echo $x ?></option>
						<?php
						} 
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="arsip" class="form-control" required="required">
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection