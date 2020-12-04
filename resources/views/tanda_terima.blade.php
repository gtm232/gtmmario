<html>
	<head>

	</head>
	
	<body>
	<?php
		$lb=DB::table('laporan_bulanan')->where('id',$id_laporan_bulanan)->first();
		
		if($lb->bulan == 1){
			$nama_bulan="Januari";
		}else if($lb->bulan == 2){
			$nama_bulan="Februari";
		}else if($lb->bulan == 3){
			$nama_bulan="Maret";
		}else if($lb->bulan == 4){
			$nama_bulan="April";
		}else if($lb->bulan == 5){
			$nama_bulan="Mei";
		}else if($lb->bulan == 6){
			$nama_bulan="Juni";
		}else if($lb->bulan == 7){
			$nama_bulan="Juli";
		}else if($lb->bulan == 8){
			$nama_bulan="Agustus";
		}else if($lb->bulan == 9){
			$nama_bulan="September";
		}else if($lb->bulan == 10){
			$nama_bulan="Oktober";
		}else if($lb->bulan == 11){
			$nama_bulan="November";
		}else if($lb->bulan == 12){
			$nama_bulan="Desember";
		}
		
	$wo=DB::table('wilayah_operasi')->where('id_laporan_bulanan',$id_laporan_bulanan)->get();
	?>
		<table align="center" border="1" width="460">
			<tr>
				<td align="center" colspan="4" style="background:red; color:yellow; font-size:30px;"><h3><b>Tanda Terima Bulan {{$nama_bulan}}</b></h3></td>
			</tr>
			
			@foreach($wo as $wo)
				
				
				
				
				<?php
					$jl=DB::table('jenis_laporan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['id_wilayah_operasi',$wo->id],])->get();
					
				?>
				@foreach($jl as $jl)
					<?php
						$dlb=DB::table('dokumen_laporan_bulanan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['wilayah_operasi',$wo->id],['jenis_laporan',$jl->id],])->get();
						$dlb2=DB::table('dokumen_laporan_bulanan')->where([['id_laporan_bulanan',$id_laporan_bulanan],['wilayah_operasi',$wo->id],['jenis_laporan',$jl->id],])->count();
						
					?>
				<tr>
					<td align="center" style="background:grey; color:white;" colspan="4">{{$wo->wilayah_operasi}} - {{$jl->jenis}}</td> 
				</tr>
				
				
				@if($dlb2 > 0)
					<tr>
					<td align="center">No</td>
					<td align="center">File Yang dilampirkan</td>
					<td align="center">Tanggal</td>
					<td align="center">Keterangan Status</td>
				</tr>
					<?php
					$no=1;
					?>
						@foreach($dlb as $dlb)
							
								<tr>
									<td width="10" align="center">{{$no}}</td>
									<td style="Word-wrap:break-Word;" width="200">{{$dlb->prihal}}</td>
									<td width="100" align="center">{{$dlb->tanggal}}</td>
									<td width="150" align="center">
									<?php
										$status_dok=DB::table('notif_catatan_revisi')->where([['id_jenis_laporan',$jl->id],['id_dokumen_laporan',$dlb->id],])->orderBy('id','DESC')->get()->first();
										$status_dok2=DB::table('notif_catatan_revisi')->where([['id_jenis_laporan',$jl->id],['id_dokumen_laporan',$dlb->id],])->count();
										if($status_dok2 > 0){
										echo $status_dok->status;
										}
									?>
									</td>
									
								</tr>
						<?php
						$no++;
						?>
						@endforeach	
							
				@elseif($dlb2 == 0)
								<tr>
									<td colspan="4" align="center">Tidak Ada File yg dilampirkan</td>
								</tr>
						@endif		
						
				@endforeach
				
			@endforeach
			
		</table>
			
	</body>
</html>