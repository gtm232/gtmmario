
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="text-align:center; margin-bottom:15px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Pekerjaan Pagu</h3>
                        
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
                               
			
           
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:0px 15px 10px 15px;">
			  <?php
			$laporan_pekerjaan_pagu=DB::table('laporan_pekerjaan_pagu')->where('id','=',$id_laporan_pekerjaan)->get()->first();
			if($laporan_pekerjaan_pagu->pic == Auth::user()->id or Auth::user()->hak_akses == "admin"){
			?>
            <form style="float:left; margin:0px 5px 10px;" action="<?php echo url('/tambah_dokumen_pekerjaan_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
			</form>
			<?php
			}
			?>
			
			@if(Auth::user()->hak_akses == "admin")
			<form style="display:none;"  action="<?php echo url('/pembuatan_surat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
						<button type="submit" class="btn btn-info">Buat Dokumen</button></a>
			</form>
			@endif
					<br>
			
			<br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Nomor Surat</th>
                      <th>Perihal</th>
					  <th>Tanggal</th>
					  <?php
					  if(Auth::user()->hak_akses == "admin" or $laporan_pekerjaan->pic == Auth::user()->id){
					  ?>
					  <th>Opsi</th>
					  <?php } ?>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $no=1;
				  $dokumen_laporan_pekerjaan=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id_laporan_pekerjaan','=',$id_laporan_pekerjaan)->orderBy('no_urut', 'DESC')->get();
				  ?>
				  @foreach($dokumen_laporan_pekerjaan as $pkn)
                    <tr>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->no_surat}}</div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->nama}}</div></a></td>
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{date('d-m-Y',strtotime($pkn->tanggal))}}</div></a></td>
					  
                      
					   <div style="display:none;">
					<form id="dbln{{$no}}" action="<?php echo url('/lihat_dokumen_pekerjaan_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
						<input type="hidden" name="id" value="{{$pkn->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					 
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
						<table>
							<tr>
							
							<?php
								if($pkn->jenis_dokumen == "SPK"){
							?>
							<td style="border:0px;">
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('spk_dev{{$no}}').submit()"><i class="material-icons">filter_frames</i></a> 
							<form id="spk_dev{{$no}}" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/spk_dev_pagu'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="hidden" name="id" value="{{$pkn->id}}">
								<button type="submit" class="btn btn-primary">Edit</button></a>
							</form>
							</td>
							<?php
								}
							?>
							
							<td style="border:0px;">
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('edit{{$no}}').submit()"><i class="material-icons">create</i></a> 
							<form id="edit{{$no}}" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/edit_dokumen_pekerjaan_pagu'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="hidden" name="id" value="{{$pkn->id}}">
								<button type="submit" class="btn btn-primary">Edit</button></a>
							</form>
							</td>
				
							<td style="border:0px;">
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a>
							<form style="display:none;" id="hapus{{$no}}" method="post" action="<?php echo url('/hapus_dokumen_pekerjaan_pagu'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$pkn->id}}">
								<input type="hidden" name="file" value="{{$pkn->file}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
							</form>
							</td>
							</tr>
						</table>
					
					  </td>
					   @endif
					   
					   <?php
					   $pic=DB::table('laporan_pekerjaan')->where('id','=',$pkn->id_laporan_pekerjaan)->get()->first();
					   ?>
					   @if(Auth::user()->hak_akses != "admin" and $pic->pic == Auth::user()->id)
					  <td>
						<table>
							<tr>
							<td style="border:0px;">
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('edit{{$no}}').submit()"><i class="material-icons">create</i></a> 
							<form id="edit{{$no}}" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/edit_dokumen_pekerjaan_pagu'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="hidden" name="id" value="{{$pkn->id}}">
								<button type="submit" class="btn btn-primary">Edit</button></a>
							</form>
							</td>
				
							<td style="border:0px;">
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a>
							<form style="display:none;" id="hapus{{$no}}" method="post" action="<?php echo url('/hapus_dokumen_pekerjaan_pagu'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$pkn->id}}">
								<input type="hidden" name="nama" value="{{$pkn->nama}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
							</form>
							</td>
							</tr>
						</table>
					
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

