@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Bulanan</h3>
                        
                    </div>
                   
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
            
			<?php $status=DB::table('pembuatan_surat')->where('id','=',$id_pembuatan_surat)->get()->first(); ?>
			@if($status->status == "Belum Konfirmasi")
            <form style="float:left; margin-right:0px 5px 10px;" action="<?php echo url('/tambah_file_pembuatan_surat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
			</form>
					<br>
			@endif
          
			<br>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th width="40%"><div style="text-align:center; width:100%;">Perihal</div></th>
					  @if($status->status == "Belum Konfirmasi")
					  <th width="20%">Opsi</th>
					  @endif
					 
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($file_pembuatan_surat as $pbs)
                    <tr>
					
					  <?php $catatan=$pbs->catatan; ?>
					  <td width="40%"><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pbs->perihal}}</div></a></td>
					  
					<div style="display:none;">
					<form id="dbln{{$no}}" action="<?php echo url('/lihat_file_pembuatan_surat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_pembuatan_surat" value="{{$pbs->id_pembuatan_surat}}">
						<input type="hidden" name="id" value="{{$pbs->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					</div>
					
					@if($status->status == "Belum Konfirmasi")
					  <td width="20%">
						
						
						<form method="post" action="<?php echo url('/hapus_file_pembuatan_surat'); ?>">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id" value="{{$pbs->id}}">
							<input type="hidden" name="id_pembuatan_surat" value="{{$pbs->id_pembuatan_surat}}">
							<input type="hidden" name="nama_file" value="{{$pbs->nama_file}}">
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

