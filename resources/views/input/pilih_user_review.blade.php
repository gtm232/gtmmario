@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-group" action="<?php echo url('/pilih_user_re_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<div class="form-group">
					<label for="isi">User Pe-Review</label>
						<select name="pelapor" class="form-control" required="required">
							<option value="">--Pilih--</option>
							<?php
							$user_review=DB::table('users')->get();
							?>
							@foreach($user_review as $user_review)
								<option value="{{$user_review->id}}">{{$user_review->name}}</option>
								
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