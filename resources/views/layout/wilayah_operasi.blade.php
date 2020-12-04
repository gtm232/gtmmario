
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-lg-12 align-self-center" style="margin-bottom:10px; text-align:center;">
						<h3 class="text-themecolor m-b-0 m-t-0">Wilayah Operasi</h3>
                    </div>
                   
                </div>
				<a href="<?php echo url('/bulanan'); ?>">
                            <i class="material-icons">reply</i>
            </a>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
            <br>                
			@if(Auth::user()->hak_akses == "admin")			
            <form style="margin:-5px 0px 10px 10px;" action="<?php echo url('/tambah_wilayah_operasi'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
			</form>
			@endif
			
			
			
			<?php
			$pelapor=DB::table('jenis_laporan')->where('id_tujuan',Auth::user()->id)->count();
			?>
			@if($pelapor != 0 and Auth::user()->hak_akses != "admin")			
            <form style="margin:-5px 0px 10px 10px;" action="<?php echo url('/selesai_melapor'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_tujuan" value="{{Auth::user()->id}}">
						<button type="submit" class="btn btn-info">Selesai Melapor</button></a>
			</form>
			@endif
			
			@if(Auth::user()->hak_akses == "admin")			
            <button style="margin-left:10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#kirim_notif_ke_pelapor">
			  Kirim Notif Ke Pelapor
			</button>
			<div class="modal fade" id="kirim_notif_ke_pelapor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form style="margin:-5px 0px 10px 10px;" action="<?php echo url('/kirim_notif_ke_pelapor'); ?>" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
							<select name="id_users" class="form-control" required="required">
								<option value="">--Pilih Pelapor--</option>
								<option value="0">Tidak Ada Pelapor</option>
								<?php
								$pelapor=DB::table('users')->get();
								?>
								@foreach($pelapor as $pelapor)
									<option value="{{$pelapor->id}}">{{$pelapor->name}}</option>
									
								@endforeach
							</select>
							<button type="submit" style="margin-top:10px;" class="btn btn-info">Kirim</button></a>
						</form>
					  </div>
					  <div class="modal-footer">
					  </div>
					</div>
				  </div>
			</div>
			
			@endif
          
            <div class="card-body ">
              <div class="table-responsive" style="margin:10px;">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Wilayah Operasi </th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $no=1; 
				  $wilayah_operasi=DB::table('wilayah_operasi')->where('id_laporan_bulanan',$id_laporan_bulanan)->get();
				  ?>
				  
				  @foreach($wilayah_operasi as $wo)
                    <tr>
					 <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$wo->wilayah_operasi}}</a></div></td>
					  
					  <div style="display:none;">
					<form id="dbln{{$no}}" action="<?php echo url('/jenis_laporan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$wo->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
					  
					<form style="float:left; margin-right:5px;" action="<?php echo url('/edit_wilayah_operasi'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id" value="{{$wo->id}}">
						<button type="submit" class="btn btn-primary">Edit</button></a>
					</form>
					  
					  <form method="post" action="<?php echo url('/hapus_wilayah_operasi'); ?>">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id" value="{{$wo->id}}">
					<input type="submit" class="btn btn-danger" value="Delete" />
				</form>
					  </td>
					  @endif
					  
                    </tr>
					<?php $no++; ?>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
         
							   
							   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection

