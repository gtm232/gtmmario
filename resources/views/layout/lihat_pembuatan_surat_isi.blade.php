
@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				<?php 
				  $pembuatan_surat_isi=DB::table('pembuatan_surat_isi')->where('id','=',$id_edit)->get()->first();
				?>
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">{{$pembuatan_surat_isi->prihal}}</h3>
                        
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
                               
			<?php $pembuatan_surat_isi2=DB::table('pembuatan_surat_isi')->where('id_pembuatan_surat','=',$id_pembuatan_surat)->get(); ?>
            <div class="card-body ">
				<select class="form-control" id="dokumen" onchange="dokumen(this.value)">
					<option value="0">-- Silahkan Pilih --</option>
					@foreach($pembuatan_surat_isi2 as $pkn)
					<option value="{{$pkn->id}}">{{$pkn->prihal}}</option>
					@endforeach
				</select>
				
				<div style="display:none;">
				<form id="bln" action="<?php echo url('/lihat_pembuatan_surat_isi'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_pembuatan_surat" value="{{$id_pembuatan_surat}}">
						<input type="hidden" name="id_edit" id="text" value="{{$pkn->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div>
		
			
			
            </div>
         <table align="center" border="0" width="70%">
			<tr><td>
				<?php $pembuatan_surat_isi4=$pembuatan_surat_isi->isi; ?>
				<?php echo $pembuatan_surat_isi4; ?>
			</td></tr>
		</table>
							   
							   
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

