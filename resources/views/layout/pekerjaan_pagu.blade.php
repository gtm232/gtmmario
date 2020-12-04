@extends('base.app')
@section('content')

	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
				

                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center" style="text-align:center; margin-bottom:10px;">
                        <h3 class="text-themecolor m-b-0 m-t-0">Laporan Pekerjaan Pagu</h3>
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
			@if(!isset($hanya_saya))
            <form style="float:left; margin:5px;" action="<?php echo url('/hanya_saya'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary">Pekerjaan Saya</button></a>
			</form>
			@else
				<a style="float:left; margin:5px;" href="<?php echo url('/pekerjaan'); ?>" class="waves-effect"><button class="btn btn-info">Semua Pekerjaan</button></a>
				
			@endif
			
					
             <a style="float:left; margin:5px;" href="{{ route('pekerjaan_pagu.create') }}" ><button class="btn btn-info">Tambah</button></a>
					<br>
			
          
			<br>
            <div class="card-body ">
              <div class="table-responsive" style="margin:20px;">
			   <div class="col-12">
			   @if(!isset($hanya_saya))
                   <select name="tahun" onchange="location = this.value;">
                      <option>Tahun</option>
					  <?php $tgl_aw=2018; $tgl_ak=date("Y"); 
                      for($i=$tgl_ak; $i>=$tgl_aw; $i--){
                      ?>
                      <option value="pekerjaan_pagu?thn={{$i}}">{{$i}}</option>
                      <?php } ?>
                      
                  </select>
				  
				<!--  
				<select id="dokumen" onchange="dokumen(this.value)">
					<option>Pilih</option>
					<option value="SPK">SPK</option>
					<option value="BAP">BAP</option>
					<option value="BAST">BAST</option>
					<option value="SPP">Tagihan</option>
					
				</select>-->
				
				<div style="display:none;">
				<form id="bln" action="<?php echo url('/carifile_pagu'); ?>" method="post"> 
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="jenisdokumen" id="text" value="">
						<button type="submit" class="btn btn-primary">save</button></a>
				</form>
				</div> 
				@else
					 <select name="tahun" onchange="location = this.value;">
                      <option>Tahun</option>
					  <?php $tgl_aw=2018; $tgl_ak=date("Y"); 
                      for($i=$tgl_ak; $i>=$tgl_aw; $i--){
                      ?>
                      <option value="hanya_saya?thn={{$i}}">{{$i}}</option>
                      <?php } ?>
                      
                  </select>
				 
				</div>
				
				@endif
				<br>
				<br>
                <table style="font-size:10px;" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th>No</th>
					  <th>Nama Pekerjaan</th>
                      <th>PIC</th>
                      <th>Batas Kontrak</th>
					  <th>Status</th>
					  <th>Nilai SPK</th>
					  <th>Wilayah Operasi</th>
					  <th>Lokasi Arsip</th>
                     
					  <th>Opsi</th>
				
					  
                    </tr>
                  </thead>
                  
                  <tbody>
				 
				  <?php $no=1; 
				  if(isset($cari)){
					if($cari == 'nego'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','Permintaan Penawaran Harga'],])->orWhere([['tahun',$tahundashboard],['status','Undangan Untuk Negosiasi'],])->orWhere([['tahun',$tahundashboard],['status','Berita Acara Atas Negosiasi'],])->orWhere([['tahun',$tahundashboard],['status','Penawaran Harga'],])->get();
					}else if($cari == 'berlangsung'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','Perintah Untuk Melaksanakan Pekerjaan'],])->get();	
					}else if($cari == 'selesai'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','Telah Melaporkan Selesainya Pekerjaan'],])->orWhere([['tahun',$tahundashboard],['status','Pemeriksaan Pekerjaan'],])->orWhere([['tahun',$tahundashboard],['status','Serah Terima Pekerjaan'],])->get();	
					}else if($cari == 'penagihan'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','Sudah Menyampaikan Penagihan'],])->get();	
					}else if($cari == 'onprogress'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','On Progress'],])->get();	
					}else if($cari == 'paid'){
						$pekerjaan=DB::table('laporan_pekerjaan_pagu')->where([['tahun',$tahundashboard],['status','Paid'],])->get();	
					}
				  }else if(isset($_GET["thn"])){
				  $pekerjaan=DB::table('laporan_pekerjaan_pagu')->where('tahun','=',$_GET["thn"])->get();
				  }else{
				  $pekerjaan=DB::table('laporan_pekerjaan_pagu')->where('tahun','=',2020)->get();
				  }
				  ?>
				
				  @foreach($pekerjaan as $pkn)
				  
				  <?php
				  $pic2=DB::table('users')->where('id','=',$pkn->pic)->get()->first();
				  ?>
				  
				    @if(isset($hanya_saya))
					   @if(Auth::user()->id == $pkn->pic)
						<tr>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$no}}</div></a> </td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->nama_pekerjaan}}</div></a> </td>
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pic2->name}}</div></a></td>
                       <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
                          <?php
                           $spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK']])->get()->first();
                           $tanggal_awal=date('Y-m-d',strtotime($spk->tanggal));
                           $tanggal_akhir = date('Y-m-d', strtotime('+'.($spk->durasi-1).' days', strtotime($tanggal_awal)));
                           echo date('d-m-Y',strtotime($tanggal_akhir));
                           ?>
                           
                       </div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->status}}</div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
					  <?php
					  $nilai_spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK'],])->sum('harga');
					  echo number_format($nilai_spk,0,',','.');
					  ?>
					  </div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->wilayah_operasi}}</div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->lokasi}}</div></a></td>
					  
					  <div style="display:none;">
						<form id="dbln{{$no}}" action="<?php echo url('/dokumen_pekerjaan_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$pkn->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
						</form>
					  </div>
					  
					  
					 <td>
					<table style="border: 0px;">
					@if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pkn->pic)
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="{{ route('pekerjaan_pagu.edit',$pkn->id) }}"><i class="material-icons">create</i></a>
					</td>
					
					@if(Auth::user()->hak_akses == "admin")
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('delete{{$no}}').submit()"><i class="material-icons">delete</i></a>
					<form style="display:none;" id="delete{{$no}}" method="post" action="{{ route('pekerjaan_pagu.destroy',$pkn->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					</td>
					
					@endif
					@endif
					</table> 
					</td>
					 
					  <?php $no++; ?>
                    </tr>
					@endif
				   
                    @elseif(isset($carifile))
							<?php 
							$cf=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen',$carifile],])->get()->count();
							?>
								@if($cf >= 1)
								  <tr>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$no}}</div></a> </td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->nama_pekerjaan}}</div></a> </td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pic2->name}}</div></a></td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
								     <?php
                                       $spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK']])->get()->first();
                                       $tanggal_awal=date('Y-m-d',strtotime($spk->tanggal));
                                       $tanggal_akhir = date('Y-m-d', strtotime('+'.($spk->durasi-1).' days', strtotime($tanggal_awal)));
                                       echo date('d-m-Y',strtotime($tanggal_akhir));
                                      
                                      ?>
								  </div></a></td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->status}}</div></a></td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
					  <?php
					  $nilai_spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK'],])->sum('harga');
					  echo number_format($nilai_spk,0,',','.');
					  ?>
					  </div></a></td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->wilayah_operasi}}</div></a></td>
								  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->lokasi}}</div></a></td>
					  
								  
								  <div style="display:none;">
									<form id="dbln{{$no}}" action="<?php echo url('/dokumen_pekerjaan_pagu'); ?>" method="post">
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="id_laporan_pekerjaan" value="{{$pkn->id}}">
									<button type="submit" class="btn btn-primary">save</button></a>
									</form>
								  </div>
								  <?php $no++; ?>
								 
								 <td>
					<table style="border: 0px;">
					@if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pkn->pic)
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="{{ route('pekerjaan_pagu.edit',$pkn->id) }}"><i class="material-icons">create</i></a>
					</td>
						
					@if(Auth::user()->hak_akses == "admin")
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('delete{{$no}}').submit()"><i class="material-icons">delete</i></a>
					<form style="display:none;" id="delete{{$no}}" method="post" action="{{ route('pekerjaan_pagu.destroy',$pkn->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					</td>
					
					@endif
					@endif
					</table> 
					</td>
								 
								 
								</tr>
							@endif
					@else 
					<tr>
					   <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$no}}</div></a> </td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->nama_pekerjaan}}</div></a> </td>
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pic2->name}}</div></a></td>
                      <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
                          <?php
                           $spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK']])->get()->first();
                           if($spk){
						   $tanggal_awal=date('Y-m-d',strtotime($spk->tanggal));
                           $tanggal_akhir = date('Y-m-d', strtotime('+'.($spk->durasi-1).' days', strtotime($tanggal_awal)));
                           echo date('d-m-Y',strtotime($tanggal_akhir));
						   }else{
							echo "Belum SPK";   
						   }
                           ?>
                      </div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->status}}</div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">
					  <?php
					  $nilai_spk=DB::table('dokumen_laporan_pekerjaan_pagu')->where([['id_laporan_pekerjaan',$pkn->id],['jenis_dokumen','SPK'],])->sum('harga');
					  echo number_format($nilai_spk,0,',','.');
					  ?>
					  </div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->wilayah_operasi}}</div></a></td>
					  <td><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()"><div style="width:100%;">{{$pkn->lokasi}}</div></a></td>
					  
                      
					  <div style="display:none;">
						<form id="dbln{{$no}}" action="<?php echo url('/dokumen_pekerjaan_pagu'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$pkn->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
						</form>
					  </div>
					  <?php $no++; ?>
					 
					  <td>
					<table style="border: 0px;">
					@if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pkn->pic)
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="{{ route('pekerjaan_pagu.edit',$pkn->id) }}"><i class="material-icons">create</i></a>
					</td>
					
					@if(Auth::user()->hak_akses == "admin")
					<td style="border: 0px;">
					<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('delete{{$no}}').submit()"><i class="material-icons">delete</i></a>
					<form style="display:none;" id="delete{{$no}}" method="post" action="{{ route('pekerjaan_pagu.destroy',$pkn->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					</td>
					
					@endif
					@endif
					</table> 
					</td>
					 
					 
                    </tr>
					@endif
					
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