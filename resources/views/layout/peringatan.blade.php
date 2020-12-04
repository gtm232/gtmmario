@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Bulanan</h3>
                        
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
          
			<br>
            <div class="card-body ">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>Nama Pekerjaan</th>
                      <th>Tanggal Mulai</th>
					  <th>Tanggal Berakhir</th>
					  <th>PIC</th>
					  <th>Lokasi Arsip</th>
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($peringatan as $pkn)
				   <?php  
							$tanggal_lahir  = strtotime($pkn->tanggal_berakhir);
							$sekarang    = time(); // Waktu sekarang
							$diff   = $sekarang - $tanggal_lahir;
							//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24 * 365)) . ' Tahun'; // Umur anda dalam hitungan tahun
							//echo 'umur anda adalah ' . floor($diff / (60 * 60 * 24)) . ' Hari'; // Umur anda dalam hitungan hari	
							$selisih= floor($diff / (60 * 60 * 24));
							
						
							
					?>
					@if($pkn->status != "CLOSED")
					@if($selisih >= -30 or $selisih > 1 )
                    <tr>
					
					  <td style="background:red; color:#ffff;">{{$selisih}}<a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%; color:#ffff;">{{$pkn->nama_pekerjaan}}</div></a> </td>
                      <td style="background:red; color:#ffff;"><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%; color:#ffff;">{{$pkn->tanggal_mulai}}</div></a></td>
                      <td style="background:red; color:#ffff;"><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%; color:#ffff;">{{$pkn->tanggal_berakhir}}</div></a></td>
                      <td style="background:red; color:#ffff;"><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%; color:#ffff;">{{$pkn->pic}}</div></a></td>
					  <td style="background:red; color:#ffff;"><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%; color:#ffff;">{{$pkn->lokasi}}</div></a></td>
                      
					  <div style="display:none;">
					  <form id="dbln{{$no}}" action="<?php echo url('/dokumen_pekerjaan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$pkn->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  @if(Auth::user()->hak_akses == "admin")
					  <td style="background:red; color:#ffff;">
					 
					 <a  style="float:left; margin-right:5px;" href="{{ route('peringatan.edit',$pkn->id) }}"><button class="btn btn-primary">Edit</button></a>
				
					  </td>
					  @endif
                    </tr>
					@endif
					@endif
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

