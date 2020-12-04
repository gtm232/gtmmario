@extends('base.app')
@section('content')
<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<form class="form-line" action="{{ route('perencanaan.update',$perencanaan->id) }}" method="post">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				
				<div class="form-line">
					<label for="isi">Nama Pekerjaan</label>
					<input type="text" name="nama_pekerjaan" class="form-control" value="{{$perencanaan->nama_pekerjaan}}" required="required">
				</div>
				
				<div class="form-line">
					<label for="isi">Estimasi</label>
					<br>
					<select name="bulan" required="required">
						<option value="{{$perencanaan->bulan}}">
						@if($perencanaan->bulan==1)
							Januari
						@elseif($perencanaan->bulan==2)
							Februari
						@elseif($perencanaan->bulan==3)
							Maret
						@elseif($perencanaan->bulan==4)
							April
						@elseif($perencanaan->bulan==5)
							Mei
						@elseif($perencanaan->bulan==6)
							Juni
						@elseif($perencanaan->bulan==7)
							Juli
						@elseif($perencanaan->bulan==8)
							Agustus
						@elseif($perencanaan->bulan==9)
							September
						@elseif($perencanaan->bulan==10)
							Oktober
						@elseif($perencanaan->bulan==11)
							November
						@elseif($perencanaan->bulan==12)
							Desember
						@endif
						</option> 
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
					
					<label for="isi" style="margin:0px 10px 0px 10px;">Sampai</label>
					
					<select name="sampai_bulan" required="required">
						<option value="{{$perencanaan->sampai_bulan}}">
						@if($perencanaan->sampai_bulan==1)
							Januari
						@elseif($perencanaan->sampai_bulan==2)
							Februari
						@elseif($perencanaan->sampai_bulan==3)
							Maret
						@elseif($perencanaan->sampai_bulan==4)
							April
						@elseif($perencanaan->sampai_bulan==5)
							Mei
						@elseif($perencanaan->sampai_bulan==6)
							Juni
						@elseif($perencanaan->sampai_bulan==7)
							Juli
						@elseif($perencanaan->sampai_bulan==8)
							Agustus
						@elseif($perencanaan->sampai_bulan==9)
							September
						@elseif($perencanaan->sampai_bulan==10)
							Oktober
						@elseif($perencanaan->sampai_bulan==11)
							November
						@elseif($perencanaan->sampai_bulan==12)
							Desember
						@endif
						</option> 
						<option value="1">Januari</option>
						<option value="2">Februari</option>
						<option value="3">Maret</option>
						<option value="4">April</option>
						<option value="5">Mei</option>
						<option value="6">Juni</option>
						<option value="7">Juli</option>
						<option value="8">Agustus</option>
						<option value="9">September</option>
						<option value="10">Oktober</option>
						<option value="11">November</option>
						<option value="12">Desember</option>
					</select>
					
					
				</div>
			
			<div class="form-line">
					<label for="isi">Tahun</label>
					<input type="number" name="tahun" class="form-control" value="{{$perencanaan->tahun}}" required="required">
			</div>
			<br>
			
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection