@extends('base.app')
@section('content')

<div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Data User</h3>
                        
                    </div>
                   
                </div>

<!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
@if(Auth::user()->hak_akses == "admin")
				<div class="row" style="margin-bottom:5px;">
					<div class="col-md-12">	
					<form style="float:left; margin-right:5px;" action="<?php echo url('/tambah_user'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary">Tambah</button></a>
					</form>
					</div>
				</div>
@endif

            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nama</th>
					  <th>Username</th>
                      <th>Email</th>
                      <th>Hak Akses</th>
                      <th>Gambar</th>
					  @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					@endif
                    </tr>
                  </thead>
                  
                  <tbody>
				  @foreach($users as $user)
                    <tr>
                      <td>{{$user->name}}</td>
					  <td>{{$user->username}}</td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->hak_akses}}</td>
                      <td><img width="40px" height="40px" src="{{ url('/') }}/img/gambar/{{$user->gambar}}"></td>
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
					  <form style="float:left; margin-right:5px;" action="<?php echo url('/edit_user'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_user" value="{{$user->id}}">
					  <button  type="submit" class="btn btn-warning">Edit</button>
					  </form>
					  <form style="float:left; margin-right:5px;" action="<?php echo url('/hapus_user'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_user" value="{{$user->id}}">
						<input type="hidden" name="gambar" value="{{$user->gambar}}">
					  <button type="submit" class="btn btn-danger">Hapus</button>
					  </form>
					  </td>
					  @endif
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              
            </div>
          </div>
							</div>
                        </div>
                    </div>
                </div>
	 
	 
@endsection
