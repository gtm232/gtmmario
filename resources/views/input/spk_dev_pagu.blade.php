@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/tambah_spk_dev_proses_pagu'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<?php
				$dolap=DB::table('dokumen_laporan_pekerjaan_pagu')->where('id',$id)->get()->first();
				$dolap2=DB::table('spk_dev_pagu')->where('id_dokumen',$id)->sum('persentasi');
				$hasil_dolap=($dolap2/100)*$dolap->harga;
				$hasil_dolap2=$dolap->harga-$hasil_dolap;
				?>
				<div class="form-line">
					<label for="isi">Tahun</label>
					<input type="hidden" name="id" class="form-control" value="{{$id}}">
					<select name="tahun" class="form-control" required="required">
						<option value="">--Pilih--</option>
						<?php
						$tahun_ini=date('Y')-2;
						$tahun_tambah=$tahun_ini+3;
						for($i=$tahun_ini; $i<$tahun_tambah; $i++){
						?>
						<option value="{{$i}}">{{$i}}</option>
						<?php
						}
						?>
					</select>
				</div>
				
				<div class="form-line">
					<label for="isi">Persentasi Pembayaran (Sisa {{number_format($hasil_dolap2,2,',','.')}} = {{($hasil_dolap2/$dolap->harga)*100}}%)</label>
					<select id="persentasi" name="persentasi" class="form-control" required="required">
						<?php
						$batas_persentasi=($hasil_dolap2/$dolap->harga)*100;
						for($i=1; $i<=$batas_persentasi; $i++){
						?>
						<option value="{{$i}}">{{$i}}</option>
						<?php
						
						}
						?>
					</select>
					
				</div>
				
				<div class="form-line">
					<label>Keterangan</label>
					  <input type="text" class="form-control" autocomplete="off" name="keterangan">
				</div>
				
				<br>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection

<script>

</script>
