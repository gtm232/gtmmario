@extends('base.app')
@section('content')
<style>

</style>
<div class="modal fade" id="check" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tanda Terima Dokumen</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form id="jd" action="<?php echo url('/histori'); ?>" method="post"> 
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_laporan_pekerjaan" value="<?php echo $id_laporan_pekerjaan; ?>">
							<input type="hidden" name="id_pembuatan_surat" value="<?php echo $id_pembuatan_surat; ?>">
							<input type="hidden" name="tanggal" value="{{date('Y-m-d')}}">
						
							<canvas style='border:1px solid black; margin-left:20%; margin-right:30%;' id='signature-pad' class='signature-pad' align="center" width='300px' height='200px'></canvas>
							
							<br/>
							<label style="margin-left:20%;">Catatan</label>
							<textarea name="catatan" style="margin-left:20%; margin-right:30%; width:300px;" class="form-control"></textarea>
							<input style="margin-left:20%; float:left; margin-top:5px; margin-right:5px;" type='button' id='click' value='click'>
							<input style="float:left; margin-top:5px; margin-right:5px;" type='button' id='clear' value='clear'>
							<img id="ttd" style=" margin-top:5px; display:none; float:left;  margin-right:5px; width:20px; height:20px;" src="<?php echo URL::to('/'); ?>/gambar/checklist.png">
							<input type="hidden" id='output' name='output'><br/>
							
						
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					  </div>
					  </form>
					  
					</div>
				  </div>
				</div>
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				<div class="row page-titles" style="margin-bottom:20px; text-align:center;">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">History</h3>
                        
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
					<?php
					$pm=DB::table('history')->where('status','belum')->count();
					?>
					@if($pm == 0)
					<form action="<?php echo url('/tambah_history'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
						<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
					</form>
					@endif
                        <div class="card">
							
                            <div class="card-block" >
            
		
            <div class="card-body ">
			
              <div class="table-responsive" style="margin:15px;">
			  	
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>No</th>
                      <th>Nomor Surat</th>
					  <th>Perihal</th>
					  <th>Tanggal Menerima</th>
					  <th>File</th>
					  <th>Nama Penerima</th>
					  <th>Catatan</th>
					  <th>Opsi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($history as $history)
					
				  <?php 
				  $h=DB::table('pembuatan_surat')->where('id',$history->id_pembuatan_surat)->get()->first();
				  $ns=DB::table('pembuatan_surat')->where('id',$history->id_pembuatan_surat)->get()->first();
				  ?>
                    <tr>
					  <td>{{$no}}</td>
					  <td>{{$ns->nomor_surat}}</td>
                      <td>{{$ns->perihal}}</td>
					  <td>
					  @if($history->tanggal_menerima != "0000-00-00")
					  {{$history->tanggal_menerima}}
					  @endif
					  </td>
					  <td><a href="<?php echo URL::to('/'); ?>/history/<?php echo $history->file; ?>"><i class="material-icons">file_download</i></a></td>
					  <td>
					  @if($history->ttd != null)
					  <img src="{{$history->ttd}}" width="70" height="50">
					  @endif
					  </td>
					  <td>{{$history->catatan}}</td>
					 
					<td>
					@if($history->status == "belum")
					<a style="float:left; margin-right:5px;" id="ck" href="javascript:" id-histori="{{$history->id}}" data-toggle="modal" data-target="#check"><i class="material-icons">check</i></a>
					@endif
					
					@if(Auth::user()->hak_akses == "admin")
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a>
							<form style="display:none;" id="hapus{{$no}}" method="post" action="<?php echo url('/hapus_histori'); ?>">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$history->id}}">
								<input type="text" name="nama_file" value="{{$history->file}}">
								<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
								<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
								<input type="submit" class="btn btn-danger" value="Delete" />
							</form>
					@endif
					</td>
					
					  
                    </tr>
					<?php $no++;?>
                   @endforeach
                  </tbody>
                </table>
				
				<div>
				<?php //echo $catatan ?> 
				</div>
				
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
