@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				

                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Rencana Pembayaran</h3>
                     
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
			<?php
				$dolap=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id',$id)->get()->first();
				$dolap2=DB::table('spk_dev_pagu')->where('id_dokumen',$id)->sum('persentasi');
				$hasil_dolap=($dolap2/100)*$dolap->harga;
				$hasil_dolap2=$dolap->harga-$hasil_dolap;
			if($hasil_dolap2!=0){
			?>
            <form style="margin:10px 0px 0px 20px;" action="<?php echo url('/tambah_spk_dev_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id" value="{{$id}}">
						<button type="submit" class="btn btn-info">Tambah</button>
			</form>
			<?php
			}
			?>
          
            <div class="card-body ">
              <div class="table-responsive" style="margin:20px;">
			
                <table style="font-size:10px;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Tahun</th>
                      <th>Persentasi</th>
                      <th>Nilai</th>
                      <th>Keterangan</th>
                     
					  <th>Opsi</th>
				
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				 
				  <?php $no=1; 
				  $spk_dev=DB::table('spk_dev_pagu')->where('id_dokumen',$id)->get();
				  ?>
				  @foreach($spk_dev as $spk_dev)
					<tr>
						<td>{{$spk_dev->tahun}}</td>
						<td>{{$spk_dev->persentasi}}</td>
						<td>{{number_format(($spk_dev->persentasi / 100) * $dolap->harga,2,',','.')}}</td>
						<td>{{$spk_dev->keterangan}}</td>
						<td>
							<table>
							<tr>
								<td style="border: 0px;">
									<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('edit{{$no}}').submit()"><i class="material-icons">delete</i></a> 
									<form id="edit{{$no}}" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/spk_dev_delete_pagu'); ?>" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="id_spk_dev" value="{{$spk_dev->id}}">
										<input type="hidden" name="id" value="{{$id}}">
										<button type="submit" class="btn btn-primary">Edit</button></a>
									</form>
								</td>
								
								<td style="border: 0px;">
									<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('popay{{$no}}').submit()"><i class="material-icons">monetization_on</i></a>  
									<form style="display:none;" id="popay{{$no}}" action="<?php echo url('/popaylistpagu'); ?>" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="id_spk_dev" value="{{$spk_dev->id}}">
										<input type="hidden" name="harga" value="{{($spk_dev->persentasi / 100) * $dolap->harga}}">
										<button type="submit" class="btn btn-primary">POPAY</button></a>
									</form>
								</td>
								
							</tr>
							</table>
						</td>
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