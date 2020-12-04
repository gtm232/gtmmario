@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/tambah_spk_dev_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<?php
				$dolap=DB::table('dokumen_laporan_pekerjaan')->where('id',$id)->get()->first();
				$dolap2=DB::table('spk_dev')->where('id_dokumen',$id)->sum('persentasi');
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
							$tahun_tambah=date('Y')+2;
							for($i=$tahun_ini; $i<$tahun_tambah; $i++){
							?>
							<option value="{{$i}}">{{$i}}</option>
							<?php
							}
							?>
						</select>
					
				</div>
				
				<div id="base_presentasi">
					<div class="form-line">
						<label for="isi">Persentasi Pembayaran (Sisa {{number_format($hasil_dolap2,2,',','.')}} = {{($hasil_dolap2/$dolap->harga)*100}}%) <a href="javascript:" ><i onclick="base_presentasi_tutup();" class="material-icons">arrow_drop_down_circle</i></a></label>
						<select id="persentasi" name="persentasi" class="form-control" required="required">
							<?php
							$batas_persentasi=100-$dolap2;
							for($i=1; $i<=$batas_persentasi; $i++){
							?>
							<option value="{{$i}}">{{$i}}</option>
							<?php
							
							}
							?>
						</select>
						
					</div>
				</div>
				
				<div id="manual_presentasi" style="display:none;">
						<label for="isi">Persentasi Pembayaran (Sisa {{number_format($hasil_dolap2,2,',','.')}} = {{($hasil_dolap2/$dolap->harga)*100}}%) <a href="javascript:" ><i onclick="base_presentasi_buka();" class="material-icons">arrow_drop_down_circle</i></a></label>
						<input id="input_manual_presentasi" class="form-control" name="manual_presentasi" onchange="setTwoNumberDecimal" type="number" step="any" min="0" max="100" value="00.00">
				</div>
					
					<script>
						function setTwoNumberDecimal(event) {
							this.value = parseFloat(this.value).toFixed(2);
					}
					</script>
				
				<div class="form-line">
					<label>Keterangan</label>
					  <input type="text" class="form-control" autocomplete="off" name="keterangan">
				</div>
				
				<div class="form-line">
					<label for="isi">Jenis Anggaran</label>
					<?php
						$jenis_anggaran=DB::table('jenis_anggaran')->get();
					?>
					<select name="jenis_anggaran" class="form-control" required="required">
						<option value="">--Pilih--</option>
						@foreach($jenis_anggaran as $jenis_anggaran)
							<option value="{{$jenis_anggaran->id}}">{{$jenis_anggaran->jenis_anggaran}}</option>
						@endforeach
					</select>
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
function base_presentasi_tutup(){
	$('#base_presentasi').fadeOut(1000);
	$('#manual_presentasi').fadeIn(1000);
}

function base_presentasi_buka(){
	$('#base_presentasi').fadeIn(1000);
	$('#manual_presentasi').fadeOut(1000);
	document.getElementById("input_manual_presentasi").value = 0;
}
</script>
