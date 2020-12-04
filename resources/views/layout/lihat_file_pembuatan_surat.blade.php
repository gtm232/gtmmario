
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				<?php 
				  $file_pembuatan_surat=DB::table('file_pembuatan_surat')->where('id','=',$id)->get()->first();
				?>
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">{{$file_pembuatan_surat->perihal}}</h3>
                        
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
                               
			<?php $file_pembuatan_surat2=DB::table('file_pembuatan_surat')->where('id_pembuatan_surat','=',$id_pembuatan_surat)->get(); ?>
            <div class="card-body ">
				<select class="form-control" id="dokumen" onchange="dokumen(this.value)">
					<option value="0">-- Silahkan Pilih --</option>
					@foreach($file_pembuatan_surat2 as $pkn)
					<option value="{{$pkn->id}}">{{$pkn->perihal}}</option>
					@endforeach
				</select>
				
				<div style="display:none;">
				<form id="bln" action="<?php echo url('/lihat_file_pembuatan_surat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
						<input type="hidden" name="id" id="text" value="">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div>
			
			<iframe width="100%" height="700" src="<?php echo URL::to('/'); ?>/file_pembuatan_surat/{{$file_pembuatan_surat->nama_file}}">
			</iframe>
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

