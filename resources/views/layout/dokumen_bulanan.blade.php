
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="margin-bottom:10px; text-align:center;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Bulanan</h3>
                        
                    </div>
                   
                </div>
				
				<a href="javascript:" onclick="document.getElementById('back_dbln').submit()">
					<i class="material-icons">reply</i>
				</a>
					  
				<div style="display:none;">
					<form id="back_dbln" action="<?php echo url('/jenis_laporan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
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
            <br>
			<?php
			$pelapor=DB::table('jenis_laporan')->where('id',$id_jenis_laporan)->get()->first();
			?>
			@if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pelapor->id_tujuan)			
             <form style="margin:-5px 0px 10px 10px;" action="<?php echo url('/tambah_dokumen_bulanan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
			</form>
			@endif		
          
            <div class="card-body ">
              <div class="table-responsive" style="margin:10px;">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Perihal</th>
                      <th>Tanggal</th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $no=1;
				  $dokumen_laporan_bulanan=DB::table('dokumen_laporan_bulanan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['jenis_laporan',$id_jenis_laporan],['wilayah_operasi',$id_wilayah_operasi],])->get();
				  ?>
				  @foreach($dokumen_laporan_bulanan as $bln)
                    <tr>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$bln->prihal}}</div></a></td>
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$bln->tanggal}}</div></a></td>
                      
					   <div style="display:none;">
					<form id="dbln{{$no}}" action="<?php echo url('/lihat_dokumen_bulanan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id" value="{{$bln->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					 
					  @if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pelapor->id_tujuan)
					  <td>
					  <form style="float:left; margin-right:5px;" action="<?php echo url('/edit_dokumen_bulanan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<input type="hidden" name="id" value="{{$bln->id}}">
						<button type="submit" class="btn btn-primary">Edit</button></a>
					</form>
				 @if(Auth::user()->hak_akses == "admin")
				<form method="post" action="<?php echo url('/hapus_dokumen_bulanan'); ?>">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="id" value="{{$bln->id}}">
					<input type="hidden" name="nama_dokumen_laporan" value="{{$bln->nama_dokumen_laporan}}">
					<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
					<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
					<input type="submit" class="btn btn-danger" value="Delete" />
				</form>
				@endif
				<select style="width:210px; margin:5px;" class="form-control" id="dokumen" onchange="statustandaterima{{$no}}(this.value)">
					<option>-- Status --</option>
					<option value="TTD Tidak Lengkap">TTD Tidak Lengkap</option>
					<option value="Hanya Ada Editable">Hanya Ada Editable</option>
				</select><br>
				
				<div style="display:none;">
				<form id="statustandaterima{{$no}}" action="<?php echo url('/statustandaterima'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$id_laporan_bulanan}}">
						<input type="hidden" name="id_wilayah_operasi" value="{{$id_wilayah_operasi}}">
						<input type="hidden" name="id_jenis_laporan" value="{{$id_jenis_laporan}}">
						<input type="hidden" name="id" value="{{$bln->id}}">
						<input type="hidden" name="text" id="text{{$no}}" value="">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div>
				<script>
					
					function statustandaterima{{$no}}(value) {
					$('#text{{$no}}').val(value);
					document.getElementById('statustandaterima{{$no}}').submit()
				}
				</script>
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

