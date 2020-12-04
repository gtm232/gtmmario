@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah Data</h2>
			<form class="form-line" action="<?php echo url('/popay_paid_proses_pagu'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				
				<div class="form-line">
					<label >Tanggal Paid</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="tanggal_paid" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					  <input type="hidden" name="id_spk_dev" value="{{$id_spk_dev}}">
					  <input type="hidden" name="id" value="{{$id}}">
					  <input type="hidden" name="harga" value="{{$harga}}">
				</div>
				
				<br>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
@endsection
