@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<form class="form-line" action="{{ route('pekerjaan_pagu.update',$pekerjaan_pagu->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				
				<div class="form-line">
					<label for="isi">Nama Pekerjaan</label>
					<input type="text" name="nama_pekerjaan" class="form-control" value="{{$pekerjaan_pagu->nama_pekerjaan}}" required="required">
					<input type="hidden" name="nama_pekerjaan_old" class="form-control" value="{{$pekerjaan_pagu->nama_pekerjaan}}" required="required">
				</div>
				
				<?php
					if(Auth::user()->hak_akses ==  "admin"){
				?>
				<div class="form-line">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="lokasi" value="{{$pekerjaan_pagu->lokasi}}" class="form-control" required="required">
				</div>
				<?php
					}else{
				?>
				
				<input type="hidden" name="lokasi" value="Belum Arsip">
				
				<?php } ?>
				
				<?php
					if(Auth::user()->hak_akses ==  "admin"){
				?>
				<div class="form-line">
					<label for="isi">PIC</label>
					<select name="pic" class="form-control" required="required">
						<?php
						$pic=DB::table('users')->where('hak_akses','=','user')->get();
						$pic2=DB::table('users')->where('id','=',$pekerjaan_pagu->pic)->get()->first();
						?>
						<option value="{{$pic2->id}}">{{$pic2->name}}</option> 
						@foreach($pic as $pic)
						<option value="{{$pic->id}}">{{$pic->name}}</option>
						@endforeach
					</select>
				</div>
				<?php
					}else{
				?>
				
				<input type="hidden" name="pic" value="{{Auth::user()->id}}">
				
				<?php } ?>
				
				
				<div class="form-line">
					<label for="isi">Wilayah Operasi</label>
					<input type="text" name="wilayah_operasi" value="{{$pekerjaan_pagu->wilayah_operasi}}" class="form-control" required="required">
				</div>
				
				<div class="form-line" >
					<label>Tahun</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tahun" autocomplete="off" name="tahun" value="{{$pekerjaan_pagu->tahun}}" >
					  <input type="hidden" value="{{$pekerjaan_pagu->tahun}}" name="tahun_old">
				</div>
			
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection