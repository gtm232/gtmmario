@extends('base.app')
@section('content')

	<?php $user = DB::table('users')->where('id','=',$id_user)->get()->first(); ?>
					<form class="form-group" action="<?php echo url('/edit_user_proses'); ?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_user" value="{{$user->id}}">
						
						<div class="form-group">
							<label for="exampleInputPassword1">Nama</label>
							<input type="text" class="form-control" name="nama" value="{{$user->name}}" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Username</label>
							<input type="text" class="form-control" name="username" value="{{$user->username}}" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Email</label>
							<input type="text" class="form-control" name="email" value="{{$user->email}}" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Hak Akses</label>
							<select class="form-control" name="hak_akses" required>
								<option value="{{$user->hak_akses}}">{{$user->hak_akses}}</option>
								<option value="admin">Admin</option>
								<option value="user">User</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Password (Kosongkan jika tidak dirubah)</label>
							<input type="text" class="form-control" name="password" value="" >
							<input type="hidden" name="old_password" value="{{$user->password}}">
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Gambar (Kosongkan jika tidak dirubah)</label>
							<input type="file" class="form-control" name="gambar" >
							<input type="hidden" name="old_gambar" value="{{$user->gambar}}">
						</div>
						
						<button type="submit" class="btn btn-success">Save</button>
					</form>

@endsection
