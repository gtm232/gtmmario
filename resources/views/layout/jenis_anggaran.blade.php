@extends('base.app')
@section('content')

	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				

                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Jenis Anggaran</h3>
                        <h3 class="text-themecolor m-b-0 m-t-0">
						@if(isset($_GET['success']))
							{{$_GET['success']}}
						@endif
						</h3>
                        
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
				
             <a style="float:left; margin:5px;" href="{{ route('jenis_anggaran.create') }}" ><button class="btn btn-info">Tambah</button></a>
					<br>
			
          
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:20px;">
			   <div class="col-12">
			  
				
				<br>
				<br>
                <table style="" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>No</th>
					  <th>Jenis Anggaran</th>
                     
					  <th>Opsi</th>
				
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				 
				  <?php
				  $jenis_anggaran=DB::table('jenis_anggaran')->get();
				  $no=1;
				  ?>
				
					@foreach($jenis_anggaran as $jenis_anggaran)
						<tr>
							<td>{{$no}}</td>
							<td>{{$jenis_anggaran->jenis_anggaran}}</td>
							<td>
								<a style="float:left; margin-right:5px;" href="{{ route('jenis_anggaran.edit',$jenis_anggaran->id) }}"><i class="material-icons">create</i></a>
								<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('delete{{$no}}').submit()"><i class="material-icons">delete</i></a>
								<form style="display:none;" id="delete{{$no}}" method="post" action="{{ route('jenis_anggaran.destroy',$jenis_anggaran->id) }}">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<input type="submit" class="btn btn-danger" value="Delete" />
								</form>
							</td>
						</tr>
					<?php
						$no++;
					?>
					@endforeach
                  </tbody>
                </table>
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

<script type="text/javascript">
   function dokumen(value) {
	  
	$('#text').val(value);
	document.getElementById('bln').submit()
}
</script> 