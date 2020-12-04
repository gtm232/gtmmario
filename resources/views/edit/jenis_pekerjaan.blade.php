@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<form class="form-line" action="{{ route('jenis_pekerjaan.update',$jenis_pekerjaan->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				
				<div class="form-line">
					<label for="isi">Jenis Pekerjaan</label>
					<input type="text" name="jenis_pekerjaan" class="form-control" value="{{$jenis_pekerjaan->jenis_pekerjaan}}" required="required">
				</div>
			
				<br>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection