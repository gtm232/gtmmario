@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/spk_dev_edit_proses'); ?>" method="post" enctype="multipart/form-data">
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
						$tahun_ini=date('Y');
						$tahun_tambah=$tahun_ini+2;
						for($i=$tahun_ini; $i<$tahun_tambah; $i++){
						?>
						<option value="{{$i}}">{{$i}}</option>
						<?php
						}
						?>
					</select>
				</div>
				<input type="text" id="ll2" onclick="sayHello()">
				
				<div class="form-line">
					<label for="isi">Persentasi Pembayaran (Sisa {{number_format($hasil_dolap2,2,',','.')}} = {{($hasil_dolap2/$dolap->harga)*100}}%)</label>
					<input type="number" id="persentasi" name="persentasi" class="form-control" required="required">
					<input type="hidden" name="batas_persentasi" value="{{($hasil_dolap2/$dolap->harga)*100}}">
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
function sayHello(){
  
}
</script>
