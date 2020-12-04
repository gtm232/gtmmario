<?php
	$tahundashboard=$thn_print;
		$eproc=DB::table('spk_dev')->where('tahun',$tahundashboard)->get();
	$no=1;
?>
<table border="1" style="text-align:center; font-size:10px;">
	<tr>
		<td rowspan="2" style="background:yellow;">No</td>
		<td rowspan="2" style="background:yellow;">Program Kerja</td>
		<td rowspan="2" style="background:yellow;">Status</td>
        <td rowspan="2" style="background:yellow;">Nilai Seluruh SPK</td>
        <td colspan="2" style="background:yellow;">SPK</td>
        <td rowspan="2" style="background:yellow;">Nomor PO</td>
		<td rowspan="2" style="background:yellow;">Realisasi & Nomor Receipt</td>
		<td colspan="2" style="background:yellow;">BAP</td>
		<td colspan="2" style="background:yellow;">BAST</td>
                     
	</tr>
	
	<tr>
		<td style="background:yellow;">Nomor</td>
		<td style="background:yellow;">Tanggal</td>
		<td style="background:yellow;">Nomor</td>
		<td style="background:yellow;">Tanggal</td>
		<td style="background:yellow;">Nomor</td>
		<td style="background:yellow;">Tanggal</td>
	</tr>
		<?php 
		$onprogress=0;
				$non=0;
				$paid=0;
				$npa=0;
				$belum=0;
				$nbl=0;
		?>		
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
					echo $lp->status;
				}
				?>
			</td>
			
			<td>
				<?php
					$dspk=DB::table('dokumen_laporan_pekerjaan')->where([['id_laporan_pekerjaan',$lp->id],['jenis_dokumen','SPK']])->get()->first();
					echo number_format((($eproc->persentasi/100)*$dspk->harga),0,',','.');
				
				if($lp->status == "On Progress"){
				$onprogress=$onprogress+(($eproc->persentasi/100)*$dspk->harga);
				$non=$non+1;
				}else if($lp->status == "Paid"){
				$paid=$paid+(($eproc->persentasi/100)*$dspk->harga);
				$npa=$npa+1;
				}else{
				$belum=$belum+(($eproc->persentasi/100)*$dspk->harga);
				$nbl=$nbl+1;
				}
				
				?>
			</td>
			
			<td>
				{{$dspk->no_surat}}
			</td>
			
			<td>
				{{date('d-m-Y',strtotime($dspk->tanggal))}}
			</td>
			
			<td>
				<?php
					$nomor_po=DB::table('eproc')->where('id_spk_dev',$eproc->id)->get()->first();
				?>
				
				<?php
					if($nomor_po and $nomor_po->nomor_po != 0){
				?>
				{{$nomor_po->nomor_po}}
				<?php
					}
				?>
				
			</td>
			
			<td>
				<?php
					if($nomor_po and $nomor_po->nomor_receipt != 0){
				?>
					{{$nomor_po->nomor_receipt}}
				<?php
					}
				?>
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
	<tr>
		<td colspan="3">Belum Masuk Popay = {{number_format(($belum),0,',','.')}} dari {{$nbl}} Pekerjaan</td>
		<td colspan="3">On Progress = {{number_format(($onprogress),0,',','.')}} dari {{$non}} Pekerjaan</td>
		<td colspan="3">Paid = {{number_format(($paid),0,',','.')}} dari {{$npa}} Pekerjaan</td>
		<td colspan="3">Nilai Seleruh SPK = {{number_format(($onprogress+$paid+$belum),0,',','.')}} dari {{$nbl+$non+$npa}} Pekerjaan</td>
	</tr>
</table>