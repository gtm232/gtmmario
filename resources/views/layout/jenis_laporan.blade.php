
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-lg-12 align-self-center" style="margin-bottom:10px; text-align:center;">
						<h3 class="text-themecolor m-b-0 m-t-0">Jenis Laporan</h3>
                    </div>
                   
                </div>
				
				<a href="javascript:" onclick="document.getElementById('back_dbln').submit()">
					<i class="material-icons">reply</i>
				</a>
                      
				<div style="display:none;">
					<form id="back_dbln" action="<?php echo url('/wilayah_operasi'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
				</div>
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
        
            @if(Auth::user()->hak_akses == "admin")             
			<br>
				<form style="margin-top:-3px; margin-left:10px;" action="<?php echo url('/tambah_jenis_laporan'); ?>" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
							<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
							<button type="submit" class="btn btn-info">Tambah</button></a>
				</form>
			
			@endif
          
            <div class="card-body ">
              <div class="table-responsive" style="margin:10px;">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Jenis Laporan</th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $no=1; 
				  $jenis_laporan=DB::table('jenis_laporan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['id_wilayah_operasi',$id_wilayah_operasi],])->get();
				  ?>
				  
				  @foreach($jenis_laporan as $jln)
                    <tr>
					  <td>
					  <a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
					  {{$jln->jenis}} 
					  
					  <?php
					  $param_jenis2=DB::table('notif_catatan_revisi')->where('id_jenis_laporan',$jln->id)->count();
					  $param_jenis=DB::table('notif_catatan_revisi')->where('id_jenis_laporan',$jln->id)->get()->first();
					  ?>
					  @if($param_jenis2 != 0 and $param_jenis->status == "Revisi")
						<i class="material-icons" style="color:red;">warning</i>
					  @endif
					  </div></a>
					  </td>
					 
					  <div style="display:none;">
					 <form id="dbln{{$no}}" action="<?php echo url('/dokumen_bulanan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$jln->id}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  
					 @if(Auth::user()->hak_akses == "admin") 
					 <td>
					<form style="float:left; margin-right:5px;" action="<?php echo url('/edit_jenis_laporan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$jln->id}}}">
						<input type="hidden" name="id" value="{{$jln->id}}">
						<button type="submit" class="btn btn-primary">Edit</button></a>
					</form>
					
					<?php
						$ict=DB::table('notif_catatan_revisi')->where('id_jenis_laporan',$jln->id)->get()->first();
						$ict_i=DB::table('notif_catatan_revisi')->where('id_jenis_laporan',$jln->id)->count();
						
						if($ict_i != 0){
						if($ict->status != "Ok"){
					?>
					
					<button style="float:left; margin-right:5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#kirim_notif_ke_pelapor{{$no}}">
					  Pilih User Review
					</button>
					<div class="modal fade" id="kirim_notif_ke_pelapor{{$no}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  
							  <div class="modal-body">
								<form id="pilih_user_review{{$no}}" target="_blank" style="margin:-5px 0px 10px 10px;" action="<?php echo url('/pilih_user_review'); ?>" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="id_notif_catatan_review" value="{{$ict->id}}">
									<select name="user_review" class="form-control" required="required">
										<option value="">--Pilih--</option>
										<?php
										$pelapor=DB::table('users')->get();
										?>
										@foreach($pelapor as $pelapor)
											<option value="{{$pelapor->id}}">{{$pelapor->name}}</option>
											
										@endforeach
									</select>
									<button type="submit" style="display:none; margin-top:10px;" class="btn btn-info">Kirim</button></a>
								</form>
								<button onclick="simpan_user_review{{$no}}();" style="float:left; margin-right:5px;" type="button" class="btn btn-primary">
								  Simpan
								</button>
								<div style="display:none;">
									<form id="back_jenis_laporan" action="<?php echo url('/jenis_laporan'); ?>" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
										<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
										<button type="submit" class="btn btn-primary">save</button></a>
									</form>
								</div>
							  </div>
							  
							  <script>
								function simpan_user_review{{$no}}(){
									document.getElementById('pilih_user_review{{$no}}').submit();
									window.setTimeout(refresh_simpan_user_review, 1000);
								}

								function refresh_simpan_user_review(){
									document.getElementById('back_jenis_laporan').submit();
								}
							  </script>
							  
							  <div class="modal-footer">
							  </div>
							</div>
						  </div>
					</div>
					<?php
						}}
					?>
					  
					<form method="post" action="<?php echo url('/hapus_jenis_laporan'); ?>">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id" value="{{$jln->id}}">
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

