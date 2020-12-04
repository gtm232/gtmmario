@extends('base.app')
@section('content')

<style>
th{
	text-align:center;
}
</style>
 <?php
	$tahundashboard=date('Y');
		if(isset($_GET["thn"])){
			$eproc=DB::table('spk_dev')->where('tahun',$_GET["thn"])->get();
			$thn=$_GET["thn"];
			}else{
			$eproc=DB::table('spk_dev')->where('tahun',$tahundashboard)->get();
			$thn=$tahundashboard;
			}
			$no=1;
  ?>
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				

                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">E-Proc</h3>
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
					
            <a style="float:left; margin:5px;" href="javascript:" onclick="document.getElementById('print').submit()"><button class="btn btn-info">Print</button></a>
			<form id="print" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/print_eproc'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="thn_eproc" value="{{$thn}}">
								<button type="submit" class="btn btn-primary">Edit</button></a>
			</form>
					<br>
			
          
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:20px;">
			   <div class="col-12">
			    <select name="tahun" onchange="location = this.value;">
                      <option>Tahun</option>
					  <?php $tgl_aw=2018; $tgl_ak=date("Y"); 
                      for($i=$tgl_ak; $i>=$tgl_aw; $i--){
                      ?>
                      <option value="eproc?thn={{$i}}">{{$i}}</option>
                      <?php } ?>
                      
				</select>
				<br>
                <table style="font-size:10px;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th rowspan="2" style="vertical-align: text-top;">No</th>
					  <th rowspan="2" style="vertical-align: text-top;">Program Kerja</th>
					  <th rowspan="2" style="vertical-align: text-top;">Status</th>
                      <th rowspan="2">Nilai Seluruh SPK</th>
                      <th colspan="2">SPK</th>
                      <th <?php if(Auth::user()->hak_akses == 'Eproc' or Auth::user()->hak_akses == 'admin'){ }else {echo "rowspan='2'"; } ?> style="vertical-align: text-top;">Nomor PO</th>
					  <th <?php if(Auth::user()->hak_akses == 'Eproc' or Auth::user()->hak_akses == 'admin'){ }else {echo "rowspan='2'"; } ?> style="vertical-align: text-top;">Realisasi & Nomor Receipt</th>
					  <th colspan="2">BAP</th>
					  <th colspan="2">BAST</th>
                     
					</tr>
					
					<tr>
						<th>Nomor</th>
						<th>Tanggal</th>
						@if(Auth::user()->hak_akses == "Eproc" or Auth::user()->hak_akses == "admin")
						<th>
						<a style="" onclick="edit_nomor_po()" id="pensil1" href="javascript:"><i class="material-icons">create</i></a>
						<a style="display:none;" onclick="edit_nomor_po2()" id="pensil2" href="javascript:"><i class="material-icons">create</i></a>
						</th>
						<th>
						<a style="" onclick="edit_nomor_receipt()" id="pensil3" href="javascript:"><i class="material-icons">create</i></a>
						<a style="display:none;" onclick="edit_nomor_receipt2()" id="pensil4" href="javascript:"><i class="material-icons">create</i></a>
						</th>
						@endif
						<th>Nomor</th>
						<th>Tanggal</th>
						<th>Nomor</th>
						<th>Tanggal</th>
					</tr>
                  </thead>
                  
                  <tbody>
				 
						@foreach($eproc as $eproc)
					<tr>
						
						<td>{{$no}}</td>
						<td>
						<?php
						$dlp=DB::table('dokumen_laporan_pekerjaan')->where('id',$eproc->id_dokumen)->get()->first();
						$lp=DB::table('laporan_pekerjaan')->where('id',$dlp->id_laporan_pekerjaan)->get()->first();
						?>
						{{$lp->nama_pekerjaan}} ({{$eproc->persentasi}}%)
						</td>
						<td>
						<?php
							$status=DB::table('popay')->where('id_spk_dev',$eproc->id)->get()->first();
							if($status){
								echo $status->status;
							}else{
								//echo $lp->status;
							}
							?>
						</td>
						<td>
						<?php
						$dspk=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$lp->id],['jenis_dokumen','SPK']])->get()->first();
						echo number_format((($eproc->persentasi/100)*$dspk->harga),0,',','.');
						?>
						</td>
						<td>{{$dspk->no_surat}}</td>
						<td>{{date('d-m-Y',strtotime($dspk->tanggal))}}</td>
						<td>
							<?php
								$nomor_po=DB::table('eproc')->where('id_spk_dev',$eproc->id)->get()->first();
							?>
							<div id="nomor_po_eproc{{$no}}" style="width:100%; text-align:center; <?php if($nomor_po and $nomor_po->nomor_po != 0){  }else{ echo 'display:none;';} ?>">
								<div id="nomor_po_eprocc{{$no}}">
								<?php
									if($nomor_po and $nomor_po->nomor_po != 0){
								?>
								{{$nomor_po->nomor_po}}
								<?php
								}
								?>
								</div>
							
							</div>
							
							
							<form class="form-line" action="javascript:" style="display:none;" id="formeproc" method="post">
								<div class="form-line" >
									<input type="text" id="nomor_po{{$no}}" name="nomor_po{{$no}}" class="form-control"  autocomplete="off" required="required">
									<input type="hidden" id="_token{{$no}}" name="_token{{$no}}" value="{{csrf_token()}}">
									<input type="hidden" id="id{{$no}}" name="id" value="{{$eproc->id}}">
								</div>
								
								<div class="form-line" style="margin-top:5px;">
									<input type="submit" onclick="formEproc{{$no}}()" name="simpan" value="Simpan" class="btn btn-primary">
								</div>
							</form>
							
							
							<script>
							function formEproc{{$no}}() {
								var nomor_po = document.getElementById("nomor_po{{$no}}").value;
								var token = document.getElementById("_token{{$no}}").value;
								var id = document.getElementById("id{{$no}}").value;
								
								//alert(nomor_po);
								$.ajax({
								type: "post",
								data: "nomor_po=" + nomor_po + "&id=" + id + "&_token=" + token,
								url:"<?php echo url('/input_nomor_po'); ?>",
								success:function(data){
									
										//$("#lihat_detail_mea").html(data);
										//$("#exampleModal3").modal();
										alert('Sukses');
										document.getElementById("nomor_po_eprocc{{$no}}").innerHTML = nomor_po;
										$("#nomor_po_eproc{{$no}}").fadeIn(1000);
								}
								
								});
							}
							
							function edit_nomor_po() {
								$("#formeproc").fadeIn(100);
								$("#pensil1").fadeOut(100);
								$("#pensil2").fadeIn(100);
							}
							
							function edit_nomor_po2() {
								$("#formeproc").fadeOut(100);
								$("#pensil1").fadeIn(100);
								$("#pensil2").fadeOut(100);
							}
							</script>
						</td>
						<td>
							<div id="nomor_receipt_eproc{{$no}}" style="width:100%; text-align:center; <?php if($nomor_po and $nomor_po->nomor_receipt != 0){  }else{ echo 'display:none;';} ?>">
								<div id="nomor_receipt_eprocc{{$no}}">
								<?php
									if($nomor_po and $nomor_po->nomor_receipt != 0){
								?>
								{{$nomor_po->nomor_receipt}}
								<?php
								}
								?>
								</div>
							
							</div>
							
							
							<form class="form-line" action="javascript:" style="display:none;" id="formeproc2" method="post">
								<div class="form-line" >
									<input type="text" id="nomor_receipt{{$no}}" name="nomor_receipt{{$no}}" class="form-control"  autocomplete="off" required="required">
									<input type="hidden" id="_token{{$no}}" name="_token{{$no}}" value="{{csrf_token()}}">
									<input type="hidden" id="id{{$no}}" name="id" value="{{$eproc->id}}">
								</div>
								
								<div class="form-line" style="margin-top:5px;">
									<input type="submit" onclick="formEproca{{$no}}()" name="simpan" value="Simpan" class="btn btn-primary">
								</div>
							</form>
							
							
							<script>
							function formEproca{{$no}}() {
								var nomor_receipt = document.getElementById("nomor_receipt{{$no}}").value;
								var token = document.getElementById("_token{{$no}}").value;
								var id = document.getElementById("id{{$no}}").value;
								
								//alert(nomor_po);
								$.ajax({
								type: "post",
								data: "nomor_receipt=" + nomor_receipt + "&id=" + id + "&_token=" + token,
								url:"<?php echo url('/input_nomor_receipt'); ?>",
								success:function(data){
									
										alert('Sukses');
										document.getElementById("nomor_receipt_eprocc{{$no}}").innerHTML = nomor_receipt;
										$("#nomor_receipt_eproc{{$no}}").fadeIn(1000);
								}
								
								});
							}
							
							function edit_nomor_receipt() {
								$("#formeproc2").fadeIn(100);
								$("#pensil3").fadeOut(100);
								$("#pensil4").fadeIn(100);
							}
							
							function edit_nomor_receipt2() {
								$("#formeproc2").fadeOut(100);
								$("#pensil3").fadeIn(100);
								$("#pensil4").fadeOut(100);
							}
							</script>
						</td>
						<td>
						<?php
						$dbap=DB::table('dokumen_laporan_pekerjaan')->where('id_spk_dev',$eproc->id)->where('jenis_dokumen','BAP')->get()->first();
						if($dbap){
						echo $dbap->no_surat;
						}
						?>
						</td>
						<td>
						<?php
						if($dbap){
						echo date('d-m-Y',strtotime($dbap->tanggal));
						}
						?>
						</td>
						<td>
						<?php
						$dbast=DB::table('dokumen_laporan_pekerjaan')->where('id_spk_dev',$eproc->id)->where('jenis_dokumen','BAST')->get()->first();
						if($dbast){
						echo $dbast->no_surat;
						}
						?>
						</td>
						<td>
						<?php
						if($dbast){
						echo date('d-m-Y',strtotime($dbast->tanggal));
						}
						?>
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