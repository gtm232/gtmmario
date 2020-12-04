@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Menu Add Data</h2>
			<form class="form-group" action="{{ route('bulanan.update',$bulanan->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="form-group">
					<label for="judul">Bulan</label>
					<select name="bulan" class="form-control ">
						<option value="{{$bulanan->bulan}}">
						<?php
						if($bulanan->bulan == 1){
							$nama_bulan="Januari";
						}else if($bulanan->bulan == 2){
							$nama_bulan="Februari";
						}else if($bulanan->bulan == 3){
							$nama_bulan="Maret";
						}else if($bulanan->bulan == 4){
							$nama_bulan="April";
						}else if($bulanan->bulan == 5){
							$nama_bulan="Mei";
						}else if($bulanan->bulan == 6){
							$nama_bulan="Juni";
						}else if($bulanan->bulan == 7){
							$nama_bulan="Juli";
						}else if($bulanan->bulan == 8){
							$nama_bulan="Agustus";
						}else if($bulanan->bulan == 9){
							$nama_bulan="September";
						}else if($bulanan->bulan == 10){
							$nama_bulan="Oktober";
						}else if($bulanan->bulan == 11){
							$nama_bulan="November";
						}else if($bulanan->bulan == 12){
							$nama_bulan="Desember";
						} ?>
						{{$nama_bulan}}
						</option>
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
						<option value="{{$bulanan->tahun}}">{{$bulanan->tahun}}</option>
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
					<input type="text" name="arsip" class="form-control" value="{{$bulanan->arsip}}" required="required">
				</div>
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection