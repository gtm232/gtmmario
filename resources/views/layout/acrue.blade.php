@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Ketentuan Acrue</h3>
                        
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
                               
			@if(Auth::user()->hak_akses == "admin")			
             <a href="{{ route('acrue.create') }}" ><button class="btn btn-info">Tambah</button></a>
					<br>
            @endif
          
			<br>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Tahun</th>
                      <th>Dari</th>
                      <th>Sampai</th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($acrue as $ac)
                    <tr>
					
					  <td>{{$ac->tahun}}</td>
                      <td>{{$ac->tanggal_mulai}}</td>
                      <td>{{$ac->tanggal_akhir}}</td>
					  
					  @if(Auth::user()->hak_akses == "admin")
					  <td>
					 
					 <a  style="float:left; margin-right:5px;" href="{{ route('acrue.edit',$ac->id) }}"><button class="btn btn-primary">Edit</button></a>
					  
					<form method="post" action="{{ route('acrue.destroy',$ac->id) }}">
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

