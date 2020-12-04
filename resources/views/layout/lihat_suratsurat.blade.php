
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				<?php 
				  $suratsurat=DB::table('surat_surat')->where('id','=',$id_suratsurat)->get()->first();
				?>
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">{{$suratsurat->perihal}}</h3>
                        
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
                               
            <div class="card-body ">
				
			@if($suratsurat->jenis_surat == "Surat Masuk")
			<iframe width="100%" height="700" src="<?php echo URL::to('/'); ?>/surat_masuk/{{$suratsurat->file}}">
			</iframe>
			@else
			<iframe width="100%" height="700" src="<?php echo URL::to('/'); ?>/surat_keluar/{{$suratsurat->file}}">
			</iframe>
			@endif
            </div>
         
							   
							   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection


