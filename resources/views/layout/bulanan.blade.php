@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-lg-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Bulanan</h3>
                        
                    </div>
                   
                </div>
				
			<table>
				<tr>
				<td>
				<form action="<?php echo url('/bulan_tahun'); ?>" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="tahunbulan" value="{{$tahunbulan-1}}">
					<button type="submit" class="btn btn-primary"><<</button>
				</form>
				</td>
				<td>
				<form>
				<button type="submit" class="btn btn-primary">{{$tahunbulan}}</button>
				</form>
				</td>
				<td>
				<form action="<?php echo url('/bulan_tahun'); ?>" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="hidden" name="tahunbulan" value="{{$tahunbulan+1}}">
					<button type="submit" class="btn btn-primary">>></button>
				</form>
				</td>
				</tr>
			</table>
			<br>
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
             <a style="margin:10px;" href="{{ route('bulanan.create') }}" ><button class="btn btn-info">Tambah</button></a>
            @endif
          
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:10px;">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Bulan</th>
                      <th>Lokasi Arsip</th>
                      
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($bulanan as $bln)
                    <tr>
					
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
					  @if($bln->bulan == 1)
						Januari
					  @elseif($bln->bulan == 2)
						Februari
					  @elseif($bln->bulan == 3)
						Maret
					  @elseif($bln->bulan == 4)
						April
					  @elseif($bln->bulan == 5)
						Mei
					  @elseif($bln->bulan == 6)
						Juni
					  @elseif($bln->bulan == 7)
						Juli
					  @elseif($bln->bulan == 8)
						Agustus
					  @elseif($bln->bulan == 9)
						September
					  @elseif($bln->bulan == 10)
						Oktober
					  @elseif($bln->bulan == 11)
						November
					  @elseif($bln->bulan == 12)
						Desember
					  @endif
					  </div></a></td>
                      
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$bln->arsip}}</div></a></td>
                      
					  <div style="display:none;">
					  <form id="dbln{{$no}}" action="<?php echo url('/wilayah_operasi'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_bulanan" value="{{$bln->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  
					  <td style="width:20%;">
						<table>
							<tr>
					  @if(Auth::user()->hak_akses == "admin")
					
							
								<td style="border:none;">
									<a  style="float:left; margin-right:5px;" href="{{ route('bulanan.edit',$bln->id) }}"><button class="btn btn-primary">Edit</button></a>
								</td>
								
								<td style="border:none;">
									<form style="float:left; margin-right:5px;" method="post" action="{{ route('bulanan.destroy',$bln->id) }}">
										<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="submit" class="btn btn-danger" value="Delete" />
									</form>
								</td>
								
								<!--
								<td style="border:none;">
									<form style="float:left; margin-right:5px;" method="post" action="<?php echo url('/download_bulanan'); ?>">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id_bulanan" value="{{$bln->id}}">
										<input type="submit" class="btn btn-success" value="Download" />
									</form>
								</td>-->
						
					  @endif
					  <td style="border:none;">
									<form style="float:left; margin-right:5px;" method="post" action="<?php echo url('/tanda_terima'); ?>">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id_bulanan" value="{{$bln->id}}">
										<input type="submit" class="btn btn-success" value="Tanda Terima" />
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
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection

