@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/popay_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-line">
					<label for="isi">Nomor PR</label>
					<input type="text" name="nomorpr" class="form-control" required="required">
					<input type="hidden" name="id_spk_dev" class="form-control" value="{{$id_spk_dev}}">
				</div>
				
				<div class="form-line">
					<label >Tanggal Input</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal_input" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					  <input type="hidden" name="tgl_paid" value="0000-00-00">
				</div>
				
				<div id="harga1" class="form-line">
					<label for="judul">Jumlah</label>
					<input style="background:#ffff;" type="text" id="harga_kesepakatan" name="harga" class="form-control" value="Rp {{number_format($harga,0,',','.')}}" readonly>
				</div>
				
				<div class="form-line">
					<label for="isi">Status</label>
					<select class="form-control" name="status" >
						<option value="On Progress">On Progress</option>
						<option value="Paid">Paid</option>
					</select>
				</div><br>
				
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection
