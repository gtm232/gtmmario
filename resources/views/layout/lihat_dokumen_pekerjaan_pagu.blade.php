
@extends('base.app')
@section('content')

	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				<?php 
				  $dokumen_laporan_pekerjaan=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id','=',$id)->get()->first();
				?>
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">{{$dokumen_laporan_pekerjaan->nama}}</h3>
                        
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
                               
			<?php $dokumen_laporan_pekerjaan2=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id_laporan_pekerjaan','=',$id_laporan_pekerjaan)->get(); ?>
            <div class="card-body ">
				<select class="form-control" id="dokumen" onchange="dokumen(this.value)">
					<option value="0">-- Silahkan Pilih --</option>
					@foreach($dokumen_laporan_pekerjaan2 as $pkn)
					<option value="{{$pkn->id}}">{{$pkn->nama}}</option>
					@endforeach
				</select>
				
				<div style="display:none;">
				<form id="bln" action="<?php echo url('/lihat_dokumen_pekerjaan_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">
						<input type="hidden" name="id" id="text" value="">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div>
			<?php
			$nama_pekerjaan=DB::table('laporan_pekerjaan_pagu')->where('id','=',$id_laporan_pekerjaan)->get()->first();
			?>
			<iframe width="100%" height="700" src="<?php echo URL::to('/'); ?>/laporan_pekerjaan_pagu/{{$nama_pekerjaan->tahun}}/{{$nama_pekerjaan->nama_pekerjaan}}/{{$dokumen_laporan_pekerjaan->file}}">
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

