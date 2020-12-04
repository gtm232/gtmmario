@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-lg-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Permintaan Surat</h3>
                        
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
			@if(Auth::user()->hak_akses == "admin")			
             <a style="margin:10px;" href="{{ route('permintaan_surat.create') }}" ><button class="btn btn-info">Tambah</button></a>
            @endif
          
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:10px;">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>no</th>
                      <th>Perihal Permintaan</th>
                      <th>File LPS</th>
                      <th>Catatan</th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($permintaan_surat as $permintaan_surat)
                    <tr>
					  <td>{{$no}}</td>
					  <td>{{$permintaan_surat->perihal_permintaan}}</td>
                      <td>{{$permintaan_surat->file}}</td>
                      <td>
					  <?php echo $permintaan_surat->catatan; ?>
					  </td>
                    
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
					 
					<a  style="float:left; margin-right:5px;" href="{{ route('permintaan_surat.edit',$permintaan_surat->id) }}"><button class="btn btn-primary">Edit</button></a>
					  
					<form method="post" action="{{ route('permintaan_surat.destroy',$permintaan_surat->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
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

