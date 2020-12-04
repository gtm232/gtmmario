@extends('base.app')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<?php
				$u=DB::table('pembuatan_surat')->where('id',$id_pembuatan_surat)->get()->first(); 
				if($u->jenis_dokumen == "Undangan"){
			?> 
					<div class="card" style="margin:auto; padding:80px; width:780px;">
						
							<table style="margin:10px;" border="0">
								<tr>
									<td valign="top">Nomor</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->nomor_surat}}</td>
								</tr>
								
								<tr>
									<td valign="top">Sifat</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->sifat}}</td>
								</tr>
								
								<tr>
									<td valign="top">Lampiran</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->lampiran}}</td>
								</tr>
								
								<tr>
									<td valign="top">Perihal</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->perihal}}</td> 
								</tr>
							</table>
							
							<?php 
							$tgl=date('d',strtotime ($u->tanggal_surat)); 
							$bln1=date('M',strtotime ($u->tanggal_surat));
							if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Feb"){
							$bln="Februari";	
							}else if($bln1 == "Mar"){
							$bln="Maret";	
							}else if($bln1 == "Apr"){
							$bln="April";	
							}else if($bln1 == "May"){
							$bln="Mei";	
							}else if($bln1 == "Jun"){
							$bln="Juni";	
							}else if($bln1 == "Jul"){
							$bln="Juli";	
							}else if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Aug"){
							$bln="Agustus";	
							}else if($bln1 == "Sep"){
							$bln="September";	
							}else if($bln1 == "Oct"){
							$bln="Oktober";	
							}else if($bln1 == "Nov"){
							$bln="November";	
							}else if($bln1 == "Dec"){
							$bln="Desember";	
							} 
							$thn=date('Y',strtotime ($u->tanggal_surat));
							?>
							<div style="margin:10px; width:200px;">
							Jakarta {{$tgl}} {{$bln}} {{$thn}}
							</div>
							
							<div style="margin:10px; width:300px;">
								Kepada Yth.<br>
								<div style="width:190px; font-weight:bold;">{{$u->tujuan}}</div>
								<div style="width:370px;">{{$u->alamat}}</div>
							</div>
							
							<div style="margin:0px 10px -20px 10px; text-align:justify;">
								<?php echo $u->isi; ?>
							</div>
							
							<div style="margin:0px 10px 0px 10px; text-align:justify;">
								<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
								<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
								<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>
							</div>
						
					</div>	
			<?php
			}else if($u->jenis_dokumen == "BA Nego"){
			
							$tgl=date('d',strtotime ($u->tanggal_surat)); 
							$hari1=date('D',strtotime ($u->tanggal_surat));
							if($hari1 == "Mon"){
							$hari="Senin";	
							}else if($hari1 == "Tue"){
							$hari="Selasa";	
							}else if($hari1 == "Wed"){
							$hari="Rabu";	
							}else if($hari1 == "Thu"){
							$hari="Kamis";	
							}else if($hari1 == "Fri"){
							$hari="Jumat";	
							}else if($hari1 == "Sat"){
							$hari="Sabtu";	
							}else if($hari1 == "Sun"){
							$hari="Minggu";	
							}
							
							$bln1=date('M',strtotime ($u->tanggal_surat));
							if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Feb"){
							$bln="Februari";	
							}else if($bln1 == "Mar"){
							$bln="Maret";	
							}else if($bln1 == "Apr"){
							$bln="April";	
							}else if($bln1 == "May"){
							$bln="Mei";	
							}else if($bln1 == "Jun"){
							$bln="Juni";	
							}else if($bln1 == "Jul"){
							$bln="Juli";	
							}else if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Aug"){
							$bln="Agustus";	
							}else if($bln1 == "Sep"){
							$bln="September";	
							}else if($bln1 == "Oct"){
							$bln="Oktober";	
							}else if($bln1 == "Nov"){
							$bln="November";	
							}else if($bln1 == "Dec"){
							$bln="Desember";	
							} 
							
							
							$thn=date('Y',strtotime ($u->tanggal_surat));
							
							function penyebut($nilai) {
								$nilai = abs($nilai);
								$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
								$temp = "";
								if ($nilai < 12) {
									$temp = " ". $huruf[$nilai];
								} else if ($nilai <20) {
									$temp = penyebut($nilai - 10). " belas";
								} else if ($nilai < 100) {
									$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
								} else if ($nilai < 200) {
									$temp = " seratus" . penyebut($nilai - 100);
								} else if ($nilai < 1000) {
									$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
								} else if ($nilai < 2000) {
									$temp = " seribu" . penyebut($nilai - 1000);
								} else if ($nilai < 1000000) {
									$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
								} else if ($nilai < 1000000000) {
									$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
								} else if ($nilai < 1000000000000) {
									$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
								} else if ($nilai < 1000000000000000) {
									$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
								}     
								return $temp;
							}
						 
							function terbilang($nilai) {
								if($nilai<0) {
									$hasil = "minus ". trim(penyebut($nilai));
								} else {
									$hasil = trim(penyebut($nilai));
								}     		
								return $hasil;
							}
						 
						 
							$terbilangtanggal = $tgl;
							$terbilangtahun = $thn;

							?>
					<div class="card" style="margin:auto; padding:80px; width:780px;">
							<table border="0">
							<tr>
								<td align="left" valign="top" width="100">
									<img width="60" height="100" src="<?php echo URL::to('/'); ?>/gambar/logopgn.png">
								</td>
								<td valign="top" align="center">
									<div style="width:550px; margin-top:20px;">
									<b>BERITA ACARA KLARIFIKASI dan NEGOSIASI HARGA </b><br>
									<?php
									$p=DB::table('laporan_pekerjaan')->where('id',$u->id_laporan_pekerjaan)->get()->first();
									?>
									<b>{{$p->nama_pekerjaan}}</b><br>
									<b>Nomor:</b> {{$u->nomor_surat}}
									</div>
									
								</td>
							</tr>
							</table> <br>
							<div style="margin:0px 10px -20px 10px; text-align:justify;">
							Pada hari {{$hari}} tanggal {{ucwords(terbilang($terbilangtanggal))}} bulan {{$bln}} tahun {{ucwords(terbilang($terbilangtahun))}} (21-08-2019) bertempat di Jakarta, kami yang bertanda tangan dibawah ini:
							<br><br>
							
							<?php echo $u->namapic; ?>
							<?php echo $u->isi; ?>
							</div>
					</div>		
			<?php
			}else if($u->jenis_dokumen == "SPK"){
			?>
							<div class="card" style="margin:auto; padding:80px; width:780px;">
						
							<table style="margin:10px;" border="0">
								<tr>
									<td valign="top">Nomor</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->nomor_surat}}</td>
								</tr>
								
								<tr>
									<td valign="top">Sifat</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->sifat}}</td>
								</tr>
								
								<tr>
									<td valign="top">Lampiran</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->lampiran}}</td>
								</tr>
								
								<tr>
									<td valign="top">Perihal</td>
									<td valign="top">:</td>
									<td valign="top">{{$u->perihal}}</td> 
								</tr>
							</table>
							
							<?php 
							$tgl=date('d',strtotime ($u->tanggal_surat)); 
							$bln1=date('M',strtotime ($u->tanggal_surat));
							if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Feb"){
							$bln="Februari";	
							}else if($bln1 == "Mar"){
							$bln="Maret";	
							}else if($bln1 == "Apr"){
							$bln="April";	
							}else if($bln1 == "May"){
							$bln="Mei";	
							}else if($bln1 == "Jun"){
							$bln="Juni";	
							}else if($bln1 == "Jul"){
							$bln="Juli";	
							}else if($bln1 == "Jan"){
							$bln="Januari";	
							}else if($bln1 == "Aug"){
							$bln="Agustus";	
							}else if($bln1 == "Sep"){
							$bln="September";	
							}else if($bln1 == "Oct"){
							$bln="Oktober";	
							}else if($bln1 == "Nov"){
							$bln="November";	
							}else if($bln1 == "Dec"){
							$bln="Desember";	
							} 
							$thn=date('Y',strtotime ($u->tanggal_surat));
							?>
							<div style="margin:10px; width:200px;">
							Jakarta {{$tgl}} {{$bln}} {{$thn}}
							</div>
							
							<div style="margin:10px; width:300px;">
								Kepada Yth.<br>
								<div style="width:190px; font-weight:bold;">{{$u->tujuan}}</div>
								<div style="width:370px;">{{$u->alamat}}</div>
							</div>
							
							<div style="margin:0px 0px 10px 0px; text-align:justify;">
								<?php echo $u->isi; ?>
							</div>
							
							<div style="margin:0px 10px 0px 10px; text-align:justify;">
								<div style="width:100%; margin-bottom:10px;">Demikian disampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.</div>
								<div style="font-weight:bold; margin-bottom:80px;">Division Head, Gas Transmission Management</div>
								<div style="font-weight:bold; margin-bottom:80px;">Posma L.Sirait</div>
							</div>
						
					</div>	
			<?php
			}
			?>
		</div>	
	</div>					
						
@endsection

