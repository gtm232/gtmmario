@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/edit_jenis_laporan_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<?php $jenis_laporan = DB::table('jenis_laporan')->where('id', '=', $id)->get()->first(); ?>
				
				<div class="form-group">
					<label for="isi">Jenis Laporan</label>
					<input type="text" name="jenis_laporan" class="form-control" value="{{$jenis_laporan->jenis}}" required="required">
					<input type="hidden" name="id_laporan_bulanan" class="form-control" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_wilayah_operasi" class="form-control" value="{{$id_wilayah_operasi}}">
					<input type="hidden" name="id" class="form-control" value="{{$id}}">
				</div>
				
				<div class="form-group">
					<label for="isi">Pelapor</label>
						<select name="pelapor" class="form-control" required="required">
						<?php
						$pelapor1=DB::table('users')->where('id',$jenis_laporan->id_tujuan)->get()->first();
						?>
							<option value="{{$jenis_laporan->id_tujuan}}">
							@if($pelapor1)
							{{$pelapor1->name}}
							@else
							--Pilih Pelapor--
							@endif
							</option>
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