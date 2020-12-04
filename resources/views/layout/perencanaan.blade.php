@extends('base.app')
@section('content')

<style>
th{
	background:red;
	color:white;
}

td{
	background:yellow;
	color:blue;
}
</style> 
		
            <div class="row">
			
				<div class="card" style="min-height:100%;">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<a style="float:left; margin:5px;" href="{{ route('perencanaan.create') }}" ><button class="btn btn-info">Tambah</button></a>
					
					<table style="float:left; margin:5px;">
						<tr>
							<td style="background:white;">
								<form action="<?php echo url('/perencanaan_tahun'); ?>" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="tahundashboard" value="{{$tahundashboard-1}}">
									<button type="submit" class="btn btn-primary"><<</button>
								</form>
							</td>
								<td style="background:white;">
									<form>
									<button type="submit" class="btn btn-primary">{{$tahundashboard}}</button>
									</form>
								</td>
								<td style="background:white;">
									<form action="<?php echo url('/perencanaan_tahun'); ?>" method="post">
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input type="hidden" name="tahundashboard" value="{{$tahundashboard+1}}">
										<button type="submit" class="btn btn-primary">>></button>
									</form>
								</td>
						</tr>
					</table>
				</div>
				
					<div class="table-responsive" style="margin:15px; padding:5px;">
					
						<table class="table-bordered" width="100%" cellspacing="0">
						  <thead>
							<tr>
							  <th style="text-align:center;" rowspan="2">No</th>
							  <th style="text-align:center;" rowspan="2">Nama Pekerjaan</th>
							  <th  style="text-align:center;"colspan="12">Rencana Pengerjaan</th>
							  <th style="text-align:center;" rowspan="2">Opsi</th>
							</tr>
							
							<tr>
							  <th style="text-align:center;">Januari</th> 
							  <th style="text-align:center;">Februari</th>
							  <th style="text-align:center;">Maret</th>
							  <th style="text-align:center;">April</th> 
							  <th style="text-align:center;">Mei</th>
							  <th style="text-align:center;">Juni</th>
							  <th style="text-align:center;">Juli</th>
							  <th style="text-align:center;">Agustus</th>
							  <th style="text-align:center;">September</th>
							  <th style="text-align:center;">Oktober</th>
							  <th style="text-align:center;">November</th>
							  <th style="text-align:center;">Desember</th>
							</tr>
						  </thead>
						  
						  <tbody>
						  <?php
						  $perencanaan=DB::table('perencanaan')->where('tahun',$tahundashboard)->get();
						  $no=1;
						  ?>
							@foreach($perencanaan as $perencanaan)
							<?php
							
							?>
								<tr>
									<td>{{$no}}</td>
									<td>{{$perencanaan->nama_pekerjaan}}</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 2 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 3 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 3 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 4 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 4 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 4 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 5 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 5 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 5 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 5 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 6 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 6 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 6 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 6 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 6 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td style="text-align:center;">
									<td style="text-align:center;">
										@if($perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 7 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 8)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 8 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 9)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 8)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 9 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 10)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 9)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 8)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 10 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 11)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 10)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 9)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 8)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 11 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									<td style="text-align:center;">
										@if($perencanaan->bulan == 12)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 11)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 10)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 9)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 8)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 7)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 6)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 5)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 4)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 3)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 2)
											<i class="material-icons">done</i>
										@endif
										
										@if($perencanaan->sampai_bulan >= 12 and $perencanaan->bulan == 1)
											<i class="material-icons">done</i>
										@endif
									</td>
									
									<td>
									<a style="float:left; margin-right:5px;" href="{{ route('perencanaan.edit',$perencanaan->id) }}"><i class="material-icons">create</i></a>
									
									<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('delete{{$no}}').submit()"><i class="material-icons">delete</i></a>
									<form style="display:none;" id="delete{{$no}}" method="post" action="{{ route('perencanaan.destroy',$perencanaan->id) }}">
										<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="submit" class="btn btn-danger" value="Delete" />
									</form>
									</td>
								</tr>
							<?php $no++; ?>
							@endforeach
						  </tbody>
						</table>
						
						<div>
						<?php //echo $catatan ?> 
						</div>
					
					</div>
				</div>
			</div>
@endsection

<script type="text/javascript">
   function dokumen(value) {
	  
	$('#text').val(value);
	document.getElementById('bln').submit()
}
</script> 