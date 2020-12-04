@extends('base.app')
@section('content')
<script>
  tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools wordcount"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  // imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css',
	
  ],
   file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: 'kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'KCFinder',
            width: 700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    }
//  ...
});
  </script>
<?php
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
 
 
	
	?>
	<div class="row">
		<div class="col-md-12">
		<?php
		if($jd == "Undangan"){
		?>
				<!-- content -->
				<h2>Tambah Data</h2>
				<form class="form-line" action="<?php echo url('/tambah_dokumen_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Sifat</label>					
						<input type="text" name="sifat" class="form-control" value="Segera" required="required">				
					</div>			
					
					<div class="form-line">					
						<label for="judul">Lampiran</label>					
						<input type="text" name="lampiran" class="form-control" value="-" required="required">				
					</div>								
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
						<?php					
						$pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();					
						$perihal="Undangan Rapat Klarifikasi dan Negosiasi Harga ".$pekerjaan->nama_pekerjaan;									
						?>					
						<input type="text" name="perihal" class="form-control" value="{{$perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
					</div>								
					
					<div class="form-line">					
						<label for="judul">Tujuan</label>					
							<input type="text" name="tujuan" class="form-control" value="Project Manager MARIO PT. PGAS SOLUTION" required="required">				
					</div>
						
						<div class="form-line">
							<label for="judul">Alamat</label>
							<input type="text" name="alamat" class="form-control" value="Komplek PGN, Gedung C.Jl. KH Zainul Arifin No. 20 Jakarta 11140" required="required">				
						</div>								
					
					<div class="form-line">					
					<?php					
					$ju=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','Usulan'],])->get()->count();
					if($ju == 1){
						$nom=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','Usulan'],])->get()->first();
					}else if($ju > 1){
						$nom=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','Usulan'],])->get();					
					}else{
						$ju=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPH'],])->get()->count();
						if($ju == 1){
							$nom=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPH'],])->get()->first();
						}else if($ju > 1){
							$nom=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','SPH'],])->get();
						}
					}										
					?> 					
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">					
					<?php 		
					if($ju == 1){
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));	
					
					?>					
					Menindaklanjuti Surat Saudara nomor: {{$nom->no_surat}} perihal {{$nom->nama}} tanggal {{$tgl}} {{$bln}} {{$thn}}, dengan ini kami mengundang Saudara untuk hadir pada :					
					<?php 
					} else if($ju > 1){ 
					$no=1;
					?>
					Menindaklanjuti Surat Usulan Pekerjaan Perbaikan dari PT PGAS Solution yaitu :
					<table style="margin-top:-10px;">
					@foreach($nom as $nom)
					<?php
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));	
					?>
						<tr>
							<td valign="top">{{$no}}</td>
							<td valign="top">.</td>
							<td valign="top">{{$nom->prihal}} nomor: {{$nom->no_surat}} tanggal {{$tgl}} {{$bln}} {{$thn}}</td> <br>
						</tr>
					<?php $no++; ?>
					@endforeach
					</table>
					<?php } ?>
					<?php if($ju > 1){ ?>
					kami mengundang Saudara untuk hadir pada :
					<?php } ?>
					<table style="margin-left:40px; margin-top:-10px; font-family:Arial; font-size:14.5px;" border="0">						
					
						<tr>							
							<td valign="top">Hari/Tanggal</td>							
							<td valign="top">:</td>							
							<td valign="top"></td>						
						</tr>										
						
						<tr>							
							<td valign="top">Waktu</td>							
							<td valign="top">:</td>							
							<td valign="top"></td> 						
						</tr>												
						
						<tr>							
							<td valign="top">Tempat</td>							
							<td valign="top">:</td>							
							<td valign="top" align="justify">Ruang Rapat GTM, Graha PGAS Lantai 11 Jl. KH Zainul Arifin No. 20 Jakarta Barat.</td>				
						</tr>												
						
						<tr>							
							<td valign="top">Agenda</td>							
							<td valign="top">:</td>							
							<td valign="top" align="justify">{{$perihal}}</td>						
						</tr>					
					
					</table>																
					</textarea>					
					<script>					
					CKEDITOR.replace('catatan', {removePlugins: 'about,link,elementspath'});					
					</script>				
					</div>								
					<button type="submit" class="btn btn-info">Tambah</button>		
				</form>
		<?php
		}else if($jd == "BA Nego"){
			$angka = $harga_kesepakatan;
		?>
				<form class="form-line" action="<?php echo url('/tambah_dokumen_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
						<?php					
						$pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();					
						$perihal="BERITA ACARA KLARIFIKASI dan NEGOSIASI HARGA ".$pekerjaan->nama_pekerjaan;									
						?>					
						<input type="text" name="perihal" class="form-control" value="{{$perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
					</div>
					
					<div class="form-line">					
					<?php					
					$nom=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'ASC')->get();
					$nom_und=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','Undangan Nego'],])->orderBy('no_urut', 'DESC')->get()->first();
					$no=2;										
					?> 
					<?php
					$pic1=DB::table('pic_area')->where('id',$pic1)->get()->first();
					$pic2=DB::table('pic_area')->where('id',$pic2)->get()->first();
					$pic3=DB::table('pic_area')->where('id',$pic3)->get()->first();
					$pic4=DB::table('pic_area')->where('id',$pic4)->get()->first();
					$pic5=DB::table('pic_area')->where('id',$pic5)->get()->first();
					?>					
					<textarea name="namapic" id="catatan2">
					<div style="margin-top:5px;"><b style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">PT Perusahaan Gas Negara Tbk</b></div>
							<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
								<tr>
									<td width="100">Nama</td>
									<td width="5">:</td>
									<td>{{$pic1->nama}}</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td>{{$pic1->jabatan}}</td>
								</tr>
							</table>
							
							<table style="margin-top:5px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
								<tr>
									<td width="100">Nama</td>
									<td width="5">:</td>
									<td>{{$pic2->nama}}</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td>{{$pic2->jabatan}}</td>
								</tr>
							</table>
							
							<table style="margin-top:5px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
								<tr>
									<td width="100">Nama</td>
									<td width="5">:</td>
									<td>{{$pic3->nama}}</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td>{{$pic3->jabatan}}</td>
								</tr>
							</table>
							<div style="margin-top:5px;">disebut <b>"PIHAK PERTAMA".</b></div>
							
							<div style="margin-top:20px;"><b style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">PT PGAS Solution</b><br>
							<table style="margin-top:5px; font-family: Arial; font-size:14.5;">
								<tr>
									<td width="100">Nama</td>
									<td width="5">:</td>
									<td>{{$pic4->nama}}</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td>{{$pic4->jabatan}}</td>
								</tr>
							</table>
							
							<table style="margin-top:5px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
								<tr>
									<td width="100">Nama</td>
									<td width="5">:</td>
									<td>{{$pic5->nama}}</td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td>{{$pic5->jabatan}}</td>
								</tr>
							</table>
							<div style="margin-top:5px;">disebut <b>"PIHAK KEDUA".</b></div><br>
							<b>PIHAK PERTAMA</b> dengan <b>PIHAK KEDUA</b> secara bersama-sama disebut <b>"PARA PIHAK"</b>
					</textarea>
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					<b>PARA PIHAK</b> menerangkan terlebih dahulu hal-hal sebagai berikut : <br><br>
					Berdasarkan :
					<table style="margin-left:10px; font-family: Arial; font-size:14.5; text-align:justify; line-height: 24px; text-align:justify;">
					<tr>
							<td valign="top">1.</td>
							<td valign="top" align="justify">Perjanjian antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution tentang Amandemen Terhadap Perjanjian nomor: 054000.PK/HK.02/BU.INFRA/2017 antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution Untuk Melaksanakan Manajemen Aset Reliabilitas Infrastruktur Operasi dan Sistem Manajemen Gas (MARIO&SIMAG) nomor: 047600.PK/HK.02/BUI/2018 tanggal 31 Desember 2018;</td>
					</tr>
					@foreach($nom as $nom)
					<?php
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));	
					if($nom->no_urut <= $nom_und->no_urut){
					?>
					
						<tr>
							<td valign="top">{{$no}}.</td>
							<td valign="top" align="justify">{{$nom->nama}} nomor: {{$nom->no_surat}} tanggal {{$tgl}} {{$bln}} {{$thn}};</td>
						</tr>
					<?php } $no++; ?>
					@endforeach
					</table>
					
					Telah dilaksanakan klarifikasi dan negosiasi harga untuk pekerjaan tersebut dengan hasil sebagai berikut  :
							
					<table style="margin-left:10px; font-family: Arial; font-size:14.5; text-align:justify; line-height: 24px; text-align:justify;">
						<tr>
							<td valign="top">1</td>
							<td valign="top">.</td>
							<td valign="top" align="justify"><b>PIHAK KEDUA</b> menyetujui akan melakukan {{$pekerjaan->nama_pekerjaan}} sesuai Kerangka Acuan Kerja (KAK);</td>
						</tr>
						
						<tr>
							<td valign="top">2</td>
							<td valign="top">.</td>
							<td valign="top" align="justify"><b>PARA PIHAK</b> sepakat bahwa {{$pekerjaan->nama_pekerjaan}} dilakukan selama <b>{{$masa_pekerjaan}} hari kalender</b> dimulai dari terbitnya Surat Perintah Kerja (SPK);</td>
						</tr>
						
						<tr>
							<td valign="top">3</td>
							<td valign="top">.</td>
							<td valign="top" align="justify">
							Total harga pekerjaan yang telah disepakati adalah sebesar  <b>Rp {{number_format($harga_kesepakatan,2,',','.')}},-</b> <br>(terbilang: {{ucfirst(terbilang($angka))}} rupiah ), sebagaimana di bawah ini :<br>
							<table border="1" style="margin-top:8px; font-family: Arial; font-size:14.5;">
								<tr>
									<td width="50%" align="center">Uraian Kegiatan</td>
									<td align="center">Harga Penawaran</td>
									<td align="center">Harga Negosiasi</td>
									<td align="center">Persentasi Penurunan</td>
								</tr>
								<tr>
									<td width="50%" style="padding:3px;">{{$pekerjaan->nama_pekerjaan}}</td>
									<td align="center" style="padding:3px;">{{number_format($harga_penawaran,2,',','.')}}</td>
									<td align="center" style="padding:3px;">{{number_format($harga_kesepakatan,2,',','.')}}</td>
									<td align="center" style="padding:3px;">{{round((($harga_penawaran-$harga_kesepakatan)/$harga_penawaran)*100,2)}} %</td>
								</tr>
							</table>
							</td>
						</tr>
						
						<tr>
							<td valign="top">4</td>
							<td valign="top">.</td>
							<td valign="top" align="justify">Seluruh kesepakatan sebagaimana tersebut diatas akan berlaku setelah Surat Perintah Kerja (SPK) mendapat persetujuan <b>PARA PIHAK</b>.</td>
						</tr>
					</table>
					
					Demikian Berita Acara ini dibuat dan ditandatangani pada hari, tanggal, bulan dan tahun sebagaimana tersebut di atas.
					
					<table border="1" >
						
						<tr>
							<td align="center" colspan="3" style="font-size:15px;"><b>PT PERUSAHAAN GAS NEGARA TBK</b></td>
							<td align="center" colspan="2" style="font-size:15px;"><b>PT PGAS Solution</b></td>
						</tr>
						<tr>
							<td height="120px"><br><br><br><br><br></td>
							<td height="120px"><br><br><br><br><br></td>
							<td height="120px"><br><br><br><br><br></td>
							<td height="120px"><br><br><br><br><br></td>
							<td height="120px"><br><br><br><br><br></td>
						</tr>
						<tr>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic1->nama}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic2->nama}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic3->nama}}</td>
							<td style="font-family: Arial; font-size:13;" align="center"  height="30">{{$pic4->nama}}</td>
							<td style="font-family: Arial; font-size:13;" align="center"  height="30">{{$pic5->nama}}</td>
						</tr>
						<tr>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic1->jabatan}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic2->jabatan}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic3->jabatan}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic4->jabatan}}</td>
							<td style="font-family: Arial; font-size:13;" align="center" height="30">{{$pic5->jabatan}}</td>
						</tr>
						
					
					</table>
					
					</textarea>					
									
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}else if($jd == "SPK"){
		?>
					<h2>Tambah Data</h2>
				<form class="form-line" action="<?php echo url('/tambah_dokumen_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Sifat</label>					
						<input type="text" name="sifat" class="form-control" value="Segera" required="required">				
					</div>			
					
					<div class="form-line">					
						<label for="judul">Lampiran</label>					
						<input type="text" name="lampiran" class="form-control" value="-" required="required">				
					</div>								
					
					<div class="form-line">					
						<label for="judul">Perihal</label>
						<input style="background:#ffff;" type="hidden" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime ($tanggal_surat)) ; ?>" readonly>						
						<?php					
						$pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();					
						$perihal="Surat Perintah Kerja (SPK) ".$pekerjaan->nama_pekerjaan;									
						?>					
						<input type="text" name="perihal" class="form-control" value="{{$perihal}}" required="required">				
					</div>													
					
					<div class="form-line">					
						<label for="judul">Tujuan</label>					
							<input type="text" name="tujuan" class="form-control" value="Project Manager MARIO PT. PGAS SOLUTION" required="required">				
					</div>
						
						<div class="form-line">
							<label for="judul">Alamat</label>
							<input type="text" name="alamat" class="form-control" value="Komplek PGN, Gedung C.Jl. KH Zainul Arifin No. 20 Jakarta 11140" required="required">				
						</div>								
					
					<div class="form-line">					
					<?php					
					$nom=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'ASC')->get();
					$nom_BANego=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BA Nego'],])->orderBy('no_urut', 'DESC')->get()->first();
					$no=2;										
					?> 

					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					Berdasarkan :
					<table style="margin-left:10px; font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
					<tr>
							<td valign="top">1</td>
							<td valign="top">.</td>
							<td valign="top">Perjanjian antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution tentang Amandemen Terhadap Perjanjian nomor: 054000.PK/HK.02/BU.INFRA/2017 antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution Untuk Melaksanakan Manajemen Aset Reliabilitas Infrastruktur Operasi dan Sistem Manajemen Gas (MARIO&SIMAG) nomor: 047600.PK/HK.02/BUI/2018 tanggal 31 Desember 2018;</td>
					</tr>
					@foreach($nom as $nom)
					<?php
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));	
					if($nom->no_urut <= $nom_BANego->no_urut){
					?>
					
						<tr>
							<td valign="top">{{$no}}</td>
							<td valign="top">.</td>
							<td valign="top">{{$nom->nama}} nomor: {{$nom->no_surat}} tanggal {{$tgl}} {{$bln}} {{$thn}};</td> <br>
						</tr>
					<?php } $no++; ?>
					@endforeach
					</table>
					Dengan ini kami instruksikan kepada PT PGAS Solution untuk melaksanakan <b>{{$pekerjaan->nama_pekerjaan}}</b> dengan detail sebagai berikut :
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
						<tr>
							<td valign="top" width="170">Lokasi Pekerjaan</td>
							<td valign="top">:</td>
							<td>{{$lokasi_pekerjaan}}</td>
						</tr>
						<tr>
						<?php
						$tgl1 = date('Y-m-d',strtotime ($tanggal_surat));// pendefinisian tanggal awal
						$tgl2 = date('Y-m-d', strtotime(($masa_pekerjaan-1).'days', strtotime($tgl1))); //operasi penjumlahan tanggal sebanyak 6 hari
						//echo $tgl2; //print tanggal
							$tgl=date('d',strtotime ($tanggal_surat)); 					
							$bln1=date('M',strtotime ($tanggal_surat));
							$tgl_berakhir=date('d',strtotime ($tgl2)); 					
							$bulan_berakhir1=date('M',strtotime ($tgl2));		
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
							
							if($bulan_berakhir1 == "Jan"){
							$bulan_berakhir="Januari";
							}else if($bulan_berakhir1 == "Feb"){
							$bulan_berakhir="Februari";
							}else if($bulan_berakhir1 == "Mar"){
							$bulan_berakhir="Maret";
							}else if($bulan_berakhir1 == "Apr"){	
							$bulan_berakhir="April";
							}else if($bulan_berakhir1 == "May"){
							$bulan_berakhir="Mei";
							}else if($bulan_berakhir1 == "Jun"){
							$bulan_berakhir="Juni";
							}else if($bulan_berakhir1 == "Jul"){
							$bulan_berakhir="Juli";
							}else if($bulan_berakhir1 == "Aug"){		
							$bulan_berakhir="Agustus";
							}else if($bulan_berakhir1 == "Sep"){
							$bulan_berakhir="September";
							}else if($bulan_berakhir1 == "Oct"){
							$bulan_berakhir="Oktober";
							}else if($bulan_berakhir1 == "Nov"){
							$bulan_berakhir="November";
							}else if($bulan_berakhir1 == "Dec"){
							$bulan_berakhir="Desember";
							}		
							$thn=date('Y',strtotime ($tanggal_surat));
							$thn_berakhir=date('Y',strtotime ($tgl2));
					
						?>
							<td valign="top">Jangka Waktu</td>
							<td valign="top">:</td>
							<td>
							Jangka waktu pelaksanaan Pekerjaan adalah paling lambat <b>{{$masa_pekerjaan}} ({{ucfirst(terbilang($masa_pekerjaan))}})</b> hari kalender terhitung 
							sejak dimulainya Pekerjaan pada tanggal {{$tgl}} {{$bln}} {{$thn}} dan berakhir pada tanggal {{$tgl_berakhir}} {{$bulan_berakhir}} {{$thn_berakhir}}, 
							yang dibuktikan dengan Berita Acara Serah Terima (<b>"BAST"</b>) dan didahului oleh Berita Acara Pemeriksaan (<b>"BAP"</b>)
							</td>
						</tr>
						<tr>
							<td valign="top">Nilai Pekerjaan</td>
							<td valign="top">:</td>
							<td><b>{{$harga_pekerjaan}} ,- (harga termasuk pajak-pajak)</b></td>
						</tr>
						<tr>
						<?php
						$hp1=substr($harga_pekerjaan,3);
						$hp=str_replace(".", "", $hp1);
						?>
							<td valign="top">Terbilang</td>
							<td valign="top">:</td>
							<td valign="top">{{ucfirst(terbilang($hp))}} rupiah</td>
						</tr>
						<tr>
							<td valign="top">Ketentuan Lain</td>
							<td valign="top">:</td>
							<td>
							Tata Cara Pembayaran :<br><br>
							<div style="text-align:justify;">
							Pembayaran akan dilakukan setelah ditandatanganinya Berita Acara Serah Terima (<b>"BAST"</b>) yang didahului 
							dengan Berita Acara Pemeriksaan (<b>"BAP"</b>) dengan Prosentase 100% Realisasi fisik pekerjaan dan Pembayaran 
							100% dari biaya pelaksanaan pekerjaan.<br><br>
							
							Mekanisme pengukuran hasil pekerjaan, termasuk didalamnya denda yang berlaku, mengikuti persyaratan yang tertulis
							dalam dokumen kontrak MARIO SIMAG.
							</div>
							</td>
						</tr>
					</table>
					</textarea>	
									
					</div>								
					<button type="submit" class="btn btn-info">Tambah</button>		
				</form>
		<?php
		}else if($jd == "BAP"){
		?>
					<form class="form-line" action="<?php echo url('/tambah_dokumen_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
						<?php					
						$pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();					
						$perihal="BERITA ACARA PEMERIKSAAN ".$pekerjaan->nama_pekerjaan;									
						?>					
						<input type="text" name="perihal" class="form-control" value="{{$perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
					</div>
					
					<div class="form-line">					
					<?php					
					$nom=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'ASC')->get();
					$nom_BAST=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAST'],])->orderBy('no_urut', 'DESC')->get()->first();
					if(!$nom_BAST){
						$nom_BAST=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],])->orderBy('no_urut', 'DESC')->get()->first();	
					}
					$no=2;										
					?> 
					<?php
					$pic1=DB::table('pic_area')->where('id',$pic1)->get()->first();
					$pic2=DB::table('pic_area')->where('id',$pic2)->get()->first();
					?>					
					
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
					<tr>
							<td valign="top">1</td>
							<td valign="top">.</td>
							<td valign="top" align="justify">Perjanjian antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution tentang Amandemen Terhadap Perjanjian nomor: 054000.PK/HK.02/BU.INFRA/2017 antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution Untuk Melaksanakan Manajemen Aset Reliabilitas Infrastruktur Operasi dan Sistem Manajemen Gas (MARIO&SIMAG) nomor: 047600.PK/HK.02/BUI/2018 tanggal 31 Desember 2018;</td>
					</tr>
					
					@foreach($nom as $nom)
					<?php
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));
					
					
					if($nom->no_urut <= $nom_BAST->no_urut){
					?>
					
						<tr>
							<td valign="top">{{$no}}</td>
							<td valign="top">.</td> 
							<td valign="top" align="justify">{{$nom->nama}} nomor: {{$nom->no_surat}} tanggal {{$tgl}} {{$bln}} {{$thn}};</td>
						</tr>
					<?php } $no++; 
						$tgl1 = date('Y-m-d',strtotime ($tanggal_surat));// pendefinisian tanggal awal
						//echo $tgl2; //print tanggal
							$tgl=date('d',strtotime ($tanggal_surat)); 					
							$bln1=date('M',strtotime ($tanggal_surat));			
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
						$thn=date('Y',strtotime ($tanggal_surat));
					
					?>
					@endforeach
					
					</table>
					Menerangkan bahwa kami telah melakukan pemeriksaan atas pelaksanaan {{$pekerjaan->nama_pekerjaan}} 
					oleh PT PGAS Solution, dengan hasil sebagai berikut:
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
						<tr>
							<td valign="top">1.</td>
							<td valign="top">
							Hasil Pekerjaan PT PGAS Solution (<b>"Pelaksanaan Pekerjaan"</b>), telah memenuhi spesifikasi 
							teknis serta dinyatakan berfungsi baik dan aman untuk dioperasikan berdasarkan laporan pekerjaan. 
							sehingga Pekerjaan dapat diterima dan dinyatakan selesai sesuai perhitungan <i>progress</i> akhir 
							pada pencapaian <b>100%</b> (Seratus Persen) pada tanggal {{$tgl}} {{$bln}} {{$thn}}.
							</td>
						</tr>
						<tr>
							<td valign="top">2.</td>
							<td valign="top">
							Dengan diterimanya pemeriksaan hasil pekerjaan diatas, maka PT PGAS Solution telah 
							memenuhi syarat dan berhak untuk menerima pembayaran sebagaimana ditentukan dalam 
							Surat Perintah Kerja <b>("SPK")</b>.
							</td>
						</tr>
					</table>
					
					<div style="margin:23px;" >Demikian Berita Acara Pemeriksaan Pekerjaan ini dibuat dan ditandatangani pada hari, tanggal, bulan, 
					dan tahun sebagaimana disebut diawal Berita Acara Pemeriksaan ini dalam rangkap 2 (dua), dan masing-masing 
					mempunyai kekuatan hukum yang sama.
					<br><br>
					
					<table style="width:100%; font-family: Arial; font-size:14.5; line-height: 24px; text-align:center;">
						<tr>
							<td style="width:50%;"><b>PT Perusahaan Gas Negara Tbk</b></td>
							<td style="width:50%;"><b>PT PGAS Solution</b></td>
						</tr>
						
						<tr>
							<td><br><br><br><br><br></td>
							<td><br><br><br><br><br></td>
						</tr>
						
						<tr>
							<td><b><u>{{$pic1->nama}}</b></u></td>
							<td><b><u>{{$pic2->nama}}</b></u></td>
						</tr>
					</table></div>
					</textarea>					
									
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}else if($jd == "BAST"){
		?>
					<form class="form-line" action="<?php echo url('/tambah_dokumen_proses'); ?>" method="post"> 				
					<input type="hidden" name="_token" value="{{csrf_token()}}">				
					<input type="hidden" name="id_laporan_pekerjaan" value="{{$id_laporan_pekerjaan}}">				
					<input type="hidden" name="jenis_dokumen" value="{{$jd}}"> 	
					
					<div class="form-line">					
						<label for="judul">Nomor Surat</label>					
						<input type="text" name="nomor_surat" class="form-control" required="required">				
					</div>		
					
					<div class="form-line">					
						<label for="judul">Perihal</label>										
						<?php					
						$pekerjaan=DB::table('laporan_pekerjaan')->where('id',$id_laporan_pekerjaan)->get()->first();					
						$perihal="BERITA ACARA SERAH TERIMA ".$pekerjaan->nama_pekerjaan;									
						?>					
						<input type="text" name="perihal" class="form-control" value="{{$perihal}}" required="required">				
					</div>								
					
					<div class="form-line">					
						<label >Tanggal Surat</label>					  
						<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_surat" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>									
					</div>
					
					<div class="form-line">					
					<?php					
					$nom=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$id_laporan_pekerjaan)->orderBy('no_urut', 'ASC')->get();
					$nom_BAST=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],['jenis_dokumen','BAST'],])->orderBy('no_urut', 'DESC')->get()->first();
					if(!$nom_BAST){
						$nom_BAST=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$id_laporan_pekerjaan],])->orderBy('no_urut', 'DESC')->get()->first();	
					}
					$no=2;										
					?> 
					<?php
					$pic1=DB::table('pic_area')->where('id',$pic1)->get()->first();
					$pic2=DB::table('pic_area')->where('id',$pic2)->get()->first();
					?>					
					<textarea name="namapic" id="catatan2">
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
								<tr>
									<td valign="top">1</td>
									<td valign="top" width="100">Nama</td>
									<td valign="top" width="5">:</td>
									<td valign="top">{{$pic1->nama}}</td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td valign="top">Jabatan</td>
									<td valign="top">:</td>
									<td valign="top">{{$pic1->jabatan}}, PT Perusahaan Gas Negara Tbk</td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td valign="top" colspan="3">
									{{$pic1->alamat_kantor}}, selanjutnya disebut <b>PIHAK PERTAMA</b><br><br>
									</td>
								</tr>
								
								<tr>
									<td valign="top">2.</td>
									<td valign="top" width="100">Nama</td>
									<td valign="top" width="5">:</td>
									<td valign="top">{{$pic2->nama}}</td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td valign="top">Jabatan</td>
									<td valign="top">:</td>
									<td valign="top">{{$pic2->jabatan}}, PT PGAS Solution</td>
								</tr>
								<tr>
									<td valign="top"></td>
									<td valign="top" colspan="3">
									{{$pic2->alamat_kantor}}, selanjutnya disebut <b>PIHAK KEDUA</b>
									</td>
								</tr>
					</table>
						
					</textarea>
					
					
					<label for="isi">Isi</label>					
					<textarea name="isi" id="catatan">
					<b>PIHAK PERTAMA</b> dengan <b>PIHAK KEDUA</b> secara bersama-sama disebut <b>PARA PIHAK</b><br><br>
					Berdasarkan:
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
					<tr>
							<td valign="top">1</td>
							<td valign="top">.</td>
							<td valign="top" align="justify">Perjanjian antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution tentang Amandemen Terhadap Perjanjian nomor: 054000.PK/HK.02/BU.INFRA/2017 antara PT Perusahaan Gas Negara Tbk Business Unit Infrastructure dan PT PGAS Solution Untuk Melaksanakan Manajemen Aset Reliabilitas Infrastruktur Operasi dan Sistem Manajemen Gas (MARIO&SIMAG) nomor: 047600.PK/HK.02/BUI/2018 tanggal 31 Desember 2018;</td>
					</tr>
					@foreach($nom as $nom)
					<?php
					$tgl=date('d',strtotime ($nom->tanggal)); 					
					$bln1=date('M',strtotime ($nom->tanggal));					
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
					$thn=date('Y',strtotime ($nom->tanggal));	
					if($nom->no_urut <= $nom_BAST->no_urut){
					?>
					
						<tr>
							<td valign="top">{{$no}}</td>
							<td valign="top">.</td>
							<td valign="top" align="justify">{{$nom->nama}} nomor: {{$nom->no_surat}} tanggal {{$tgl}} {{$bln}} {{$thn}};</td>
						</tr>
					<?php } $no++; 
						$tgl1 = date('Y-m-d',strtotime ($tanggal_surat));// pendefinisian tanggal awal
						//echo $tgl2; //print tanggal
							$tgl=date('d',strtotime ($tanggal_surat)); 					
							$bln1=date('M',strtotime ($tanggal_surat));			
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
						$thn=date('Y',strtotime ($tanggal_surat));
						$hp1=substr($harga_yangdibayarkan,3);
						$hp=str_replace(".", "", $hp1);
					?>
					@endforeach
					</table>
					<b>PARA PIHAK</b> sepakat untuk melakukan serah terima atas {{$pekerjaan->nama_pekerjaan}} <b>("PEKERJAAN")</b> 
					dengan ketentuan-ketentuan dan syarat-syarat sebagai berikut :
					<table style="font-family: Arial; font-size:14.5; line-height: 24px; text-align:justify;">
						<tr>
							<td valign="top">1.</td>
							<td valign="top">
							<b>PIHAK KEDUA</b> telah menyelesaikan <b>PEKERJAAN</b> dengan baik pada tanggal {{$tgl}} {{$bln}} {{$thn}} 
							sebagaimana tertuang dalam Berita Acara Pemeriksaan <b>("BAP")</b>. Untuk selanjutnya <b>PIHAK KEDUA</b> menyerahkan <b>PEKERJAAN</b> kepada <b>PIHAK PERTAMA</b> 
							dan <b>PIHAK PERTAMA</b> menerima <b>PEKERJAAN</b> tersebut dengan baik berdasarkan Berita Acara Pemeriksaan <b>("BAP")</b>
							</td>
						</tr>
						<tr>
							<td valign="top">2.</td>
							<td valign="top">
							Bahwa setelah Berita Acara ini ditandatangani oleh <b>PIHAK PERTAMA</b>, maka  <b>PIHAK PERTAMA</b> 
							akan membayar kepada <b>PIHAK KEDUA</b> untuk pembayaran sebesar 100% (Seratus Persen) dari harga 
							kesepakatan sesuai dengan Surat Perintah Kerja <b>("SPK")</b> sebesar <b>{{$harga_yangdibayarkan}}</b> (terbilang: {{Ucfirst(terbilang($hp))}} rupiah) termasuk pajak-pajak.
							</td>
						</tr>
					</table>
					<br>
					<div >Demikian Berita Acara Serah Terima Pekerjaan ini dibuat dan ditandatangani pada hari, tanggal, bulan, 
					dan tahun sebagaimana disebut diawal. Berita Acara Serah Terima ini dalam rangkap 2 (dua), dan masing-masing 
					mempunyai kekuatan hukum yang sama.
					<br><br>
					
					<table style="width:100%; font-family: Arial; font-size:14.5; line-height: 24px; text-align:center;">
						<tr>
							<td style="width:50%;"><b>PIHAK KEDUA</b><br> PT PGAS Solution <br>{{$pic2->jabatan}}</td>
							<td style="width:50%;"><b>PIHAK PERTAMA</b><br> PT Perusahaan Gas Negara Tbk <br>{{$pic1->jabatan}}</td>
						</tr>
						
						<tr>
							<td><br><br><br><br><br></td>
							<td><br><br><br><br><br></td>
						</tr>
						
						<tr>
							<td><b><u>{{$pic2->nama}}</b></u></td>
							<td><b><u>{{$pic1->nama}}</b></u></td>
						</tr>
					</table></div>
					</textarea>					
									
					</div>
					<button type="submit" class="btn btn-info">Tambah</button>
					</form>
		<?php
		}
		?>
		</div>
	</div>
	
@endsection

