@extends('base.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form class="form-group" action="<?php echo url('/input_user_proses'); ?>" method="post" enctype='multipart/form-data'>
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						
						<div class="form-group">
							<label for="exampleInputPassword1">Nama</label>
							<input type="text" class="form-control" name="nama" value="" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Username</label>
							<input type="text" class="form-control" name="username" value="" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Email</label>
							<input type="text" class="form-control" name="email" value="" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Hak Akses</label>
							<select class="form-control" name="hak_akses" required>
								<option value="">--Pilih--</option>
								<option value="admin">Admin</option>
								<option value="user">User</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Perusahaan</label>
							<select class="form-control" name="pt" required>
								<option value="">--Pilih--</option>
								<option value="PT PGN">PT PGN</option>
								<option value="PT PGASOL">PT PGASOL</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Password</label>
							<input type="text" class="form-control" name="password" value="" required>
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Gambar</label>
							<input onchange="validasiFile()" id="file" type="file" class="form-control" name="gambar" required>
						</div>
						
						<button type="submit" class="btn btn-success">Save</button>
					</form>
                </div>
            </div>
        </div>
    
</div>
@endsection
<script>
function validasiFile(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi jpg,jpeg,png, dan gif');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}
</script>
