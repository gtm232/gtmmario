https://www.youtube.com/watch?v=uPKvBSds15k

<div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
                   <div class="table-responsive">					
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Program Kerja</th>
                      <th rowspan="2" style="vertical-align:top; text-align:center;">Lokasi</th>
                      <th rowspan="2" style="vertical-align:top; text-align:center;">Area Operasi</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Inisiator Program Kerja</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">Surat Permintaan Pekerjaan</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">SPPH</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">SPH</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">Undangan Klarifikasi & Negosisasi</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">BA Klarifikasi & Negosisasi</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">SPK</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Durasi Pekerjaan</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Mulai Pekerjaan</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">Selesai Pekerjaan</th>
					  <th colspan="2" style="vertical-align:top; text-align:center;">BAP</th>
					  <th colspan="3" style="vertical-align:top; text-align:center;">BAST</th>
					  <th colspan="3" style="vertical-align:top; text-align:center;">Invoice</th>
					  <th colspan="5" style="vertical-align:top; text-align:center;">Pembayaran POPAY</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">PPN (10%)</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">PPH</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Jumlah Terbayar</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Penawaran PGASOL</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Selisih Nego</th>
					  <th rowspan="2" style="vertical-align:top; text-align:center;">Prosentase</th>
					  
                    </tr>
					
					<tr>
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Rencana</th>
						<th>Realisasi</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						<th>Rupiah</th>
						
						<th>Nomor</th>
						<th>Tanggal</th>
						<th>Rupiah</th>
						
						<th>Nomor PR</th>
						<th>Tanggal Input</th>
						<th>Tanggal Paid</th>
						<th>Rupiah</th>
						<th>Status</th>
						
					</tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  @foreach($dashboard as $dashboard)
				  <tr>
                    <td><div style="width:200px;">{{$dashboard->nama_pekerjaan}}</div></td>
                    <td>{{$dashboard->lokasi_pekerjaan}}</td>
                    <td>{{$dashboard->area_operasi}}</td>
                    <td>{{$dashboard->inisiator_kerja}}</td>
					
					<!--usulan-->
					<?php
					$usulan=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','Usulan'],])->get()->first();
					if($usulan){
						$usulanno_surat=$usulan->no_surat;
						$usulantanggal=$usulan->tanggal;
					}else{
						$usulanno_surat="";
						$usulantanggal="";
					}
					?>
                    <td><div style="width:220px;">{{$usulanno_surat}}</div></td>
                    <td><div style="width:150px;">{{$usulantanggal}}</div></td>
					
					<!--SPPH-->
					<?php
					$SPPH=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPPH'],])->get()->first();
					if($SPPH){
						$SPPHno_surat=$SPPH->no_surat;
						$SPPHtanggal=$SPPH->tanggal;
					}else{
						$SPPHno_surat="";
						$SPPHtanggal="";
					}
					?>
                    <td>{{$SPPHno_surat}}</td>
                    <td>{{$SPPHtanggal}}</td>
					
					<!--SPH-->
					<?php
					$SPH=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPH'],])->get()->first();
					if($SPH){
						$SPHno_surat=$SPH->no_surat;
						$SPHtanggal=$SPH->tanggal;
					}else{
						$SPHno_surat="";
						$SPHtanggal="";
					}
					?>
                    <td>{{$SPHno_surat}}</td>
                    <td>{{$SPHtanggal}}</td>
					
					<!--Undangan Nego-->
					<?php
					$Undangan_Nego=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','Undangan Nego'],])->get()->first();
					if($Undangan_Nego){
						$UndanganNegono_surat=$Undangan_Nego->no_surat;
						$UndanganNegotanggal=$Undangan_Nego->tanggal;
					}else{
						$UndanganNegono_surat="";
						$UndanganNegotanggal="";
					}
					?>
                    <td>{{$UndanganNegono_surat}}</td>
                    <td>{{$UndanganNegotanggal}}</td>
					
					<!--BA Nego-->
					<?php
					$BA_Nego=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','BA Nego'],])->get()->first();
					if($BA_Nego){
						$BANegono_surat=$BA_Nego->no_surat;
						$BANegotanggal=$BA_Nego->tanggal;
					}else{
						$BANegono_surat="";
						$BANegotanggal="";
					}
					?>
                    <td>{{$BANegono_surat}}</td>
                    <td>{{$BANegotanggal}}</td>
					
					<!--SPK-->
					<?php
					$SPK=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPK'],])->get()->first();
					if($SPK){
						$SPKno_surat=$SPK->no_surat;
						$SPKtanggal=$SPK->tanggal;
					}else{
						$SPKno_surat="";
						$SPKtanggal="";
					}
					?>
                    <td>{{$SPKno_surat}}</td>
                    <td>{{$SPKtanggal}}</td>
					
					<?php
					$tanggal_mulai  = strtotime($dashboard->tanggal_mulai);
							$tangga_berakhir    = strtotime($dashboard->tanggal_berakhir); // Waktu sekarang
							$diff   = $tangga_berakhir - $tanggal_mulai;	
							$selisih= floor($diff / (60 * 60 * 24));
					?>
                    <td>{{$selisih}}</td>
                    <td>{{$dashboard->tanggal_mulai}}</td>
					
					<!--Selesai Pekerjaan-->
					<?php
						if($dashboard->realisasi == 0000-00-00){
							$realisasi="";
						}else{
							$realisasi=$dashboard->realisasi;
						}
					?>
                    <td>{{$dashboard->tanggal_berakhir}}</td>
                    <td>{{$realisasi}}</td>
					
					<!--BAP-->
					<?php
					$BAP=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','BAP'],])->get()->first();
					if($BAP){
						$BAPno_surat=$BAP->no_surat;
						$BAPtanggal=$BAP->tanggal;
					}else{
						$BAPno_surat="";
						$BAPtanggal="";
					}
					?>
                    <td>{{$BAPno_surat}}</td>
                    <td>{{$BAPtanggal}}</td>
					
					<!--BAST-->
					<?php
					$BAST=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','BAST'],])->get()->first();
					if($BAST){
						$BASTno_surat=$BAST->no_surat;
						$BASTtanggal=$BAST->tanggal;
						$BASTharga_pekerjaan=$BAST->harga_pekerjaan;
					}else{
						$BASTno_surat="";
						$BASTtanggal="";
						$BASTharga_pekerjaan="";
					}
					?>
                    <td>{{$BASTno_surat}}</td>
                    <td>{{$BASTtanggal}}</td>
                    <td>{{$BASTharga_pekerjaan}}</td>
					
					<!--Invoice-->
					<?php
					$Invoice=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPP'],])->get();
					$Invoice2=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPP'],])->get();
					$Invoice3=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPP'],])->get();
					?>
                    <td>
					@foreach($Invoice as $Invoice)
						<div style="width:220px;">{{$Invoice->no_surat}}</div><br>
					@endforeach
					</td>
                    <td>
					@foreach($Invoice2 as $Invoice)
						<div style="width:100px;">{{$Invoice->tanggal}}</div><br>
					@endforeach
					</td>
                    <td>
					@foreach($Invoice3 as $Invoice)
						<div style="width:150px;">{{$Invoice->harga_pekerjaan}}</div><br>
					@endforeach
					</td>
					
					<!--POPAY-->
					<?php
					$Popay=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					$Popay2=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					$Popay3=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					$Popay4=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					$Popay5=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					?>
                    <td>
					@foreach($Popay as $popay)
						<div style="width:150px;">{{$popay->nomor_pr}}</div><br>
					@endforeach
					</td>
                    <td >
					@foreach($Popay2 as $popay)
						<div style="width:100px;">{{$popay->tanggal_input}}</div><br>
					@endforeach
					</td>
                    <td>
					@foreach($Popay3 as $popay)
						<div style="width:100px;">{{$popay->tanggal_paid}}</div><br>
					@endforeach
					</td>
                    <td>
					@foreach($Popay4 as $popay)
						<div style="width:150px;">{{$popay->rupiah}}</div><br>
					@endforeach
					</td>
                    <td>
					@foreach($Popay5 as $popay)
						<div style="width:100px;">{{$popay->status}}</div><br>
					@endforeach
					</td>
					
					<!--PPN-->
					<?php
					$PPN=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPP'],])->get();
					?>
                    <td>
					@foreach($PPN as $PPN)
						{{$PPN->harga_pekerjaan * 0.1}}<br>
					@endforeach
					</td>
					
					<!--PPH-->
                    <td></td>
					
					<!--Jumlah Terbayar-->
					<?php
					$Popay=DB::table('popay')->where('id_laporan_pekerjaan','=',$dashboard->id)->get();
					?>
                    <td>
					@foreach($Popay as $Popay)
						
						@if($Popay->status == "Paid")
						{{$Popay->rupiah}}
						@endif
						<br>
					@endforeach
					</td>
					
					<!--Penawaran PGASOL-->
					<?php
					$Penawaran_PGASOL=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPH'],])->get();
					?>
                    <td>
					@foreach($Penawaran_PGASOL as $Penawaran_PGASOL)
						{{number_format($Penawaran_PGASOL->harga_pekerjaan,2,',','.')}}<br>
					@endforeach
					</td>
					
					<!--Selisih Nego-->
					<?php
					$SPK=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPK'],])->get()->first();
					$Penawaran_PGASOL=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$dashboard->id],['jenis_dokumen','SPH'],])->get()->first();
					?>
					
                    <td>
					@if($SPK and $Penawaran_PGASOL)
					{{$Penawaran_PGASOL->harga_pekerjaan - $SPK->harga_pekerjaan }}
					@endif
					<br>
					</td>
					
					<!--Prosentase-->
                    <td>
					@if($SPK and $Penawaran_PGASOL)
					{{(($Penawaran_PGASOL->harga_pekerjaan - $SPK->harga_pekerjaan)/$Penawaran_PGASOL->harga_pekerjaan)*100}}%
					@endif
					<br>
					</td>
					
					<?php $no++; ?>
					</tr>
                   @endforeach
                  </tbody>
                </table>
			</div>
			</div>
			</div>
			</div>
			</div>
				