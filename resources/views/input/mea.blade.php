@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah MEA</h2>
			<form class="form-line" action="{{ route('mea.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-line">
					<label >Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					
				</div>
				
				<div class="form-line">
					<label >Wilayah</label>
					<select class="form-control" name="wilayah" id="wilayah">
						<option>--Pilih--</option>
						<option value="WOSS">WOSS</option>
						<option value="WOL">WOL</option>
						<option value="WOJBB">WOJBB</option>
					</select>
				</div>
				
				<div class="form-line">
					<label >Penanggung Jawab PT PGN</label>
					<select type="text" id="PenanggungJawabPTPGN" class="form-control" name="pj1" required>
						<?php
						$pjpgn=DB::table('users')->where('pt','PT PGN')->get();
						?>
						<option>--pilih--</option>
						@foreach($pjpgn as $pjpgn)
						<option value="{{$pjpgn->id}}">{{$pjpgn->name}}</option>
						@endforeach
					</select>
					
				</div>
				
				<div class="form-line">
					<label >Lokasi</label>
					<select class="form-control" name="lokasi" id="lokasi">
						<option>--Pilih--</option>
						<option value="Stasiun Bojonegara">Stasiun Bojonegara</option>
						<option value="Stasiun Muara Bekasi">Stasiun Muara Bekasi</option>
						<option value="Stasiun Terbanggi Besar">Stasiun Terbanggi Besar</option>
						<option value="Stasiun Labuhan Maringgai">Stasiun Labuhan Maringgai</option>
						<option value="Stasiun Pagardewa">Stasiun Pagardewa</option>
						<option value="Stasiun Metering Pagardewa">Stasiun Metering Pagardewa</option>
						<option value="Stasiun Talang Duku">Stasiun Talang Duku</option>
						<option value="Stasiun Grissik">Stasiun Grissik</option>
						<option value="Section 1">Section 1</option>
						<option value="Section 2">Section 2</option>
						<option value="Section 3">Section 3</option>
						<option value="Section 4">Section 4</option>
						<option value="Section 5">Section 5</option>
						<option value="Section 6">Section 6</option>
					</select>
				</div>
				
				<div class="form-line">
					<label >Penanggung Jawab PT PGAS Solution</label>
					<select type="text" id="PenanggungJawabPTPGASOL" class="form-control" name="pj2" required>
						<?php
						$pjpgsol=DB::table('users')->where('pt','PT PGASOL')->get();
						?>
						<option>--pilih--</option>
						@foreach($pjpgsol as $pjpgsol)
						<option value="{{$pjpgsol->id}}">{{$pjpgsol->name}}</option>
						@endforeach
					</select>
					
				</div>
				
				<div class="form-line">
					<label>Expired</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl2" autocomplete="off" name="expired" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					
				</div>
				
				<div class="form-line">
					<label >Status</label>
					<select class="form-control" name="status">
						<option>--Pilih--</option>
						<option value="Open">Open</option>
						<option value="Closed">Closed</option>
					</select>
				</div>
				
				<div class="form-line">
					<label >Penyusun 1</label>
					<select class="form-control" name="penyusun1">
						<option>--Pilih--</option>
						<?php
						$penyusun1=DB::table('users')->get();
						?>
						@foreach($penyusun1 as $penyusun1)
						<option value="{{$penyusun1->id}}">{{$penyusun1->name}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-line">
					<label >Penyusun 2</label>
					<select class="form-control" name="penyusun2">
						<option>--Pilih--</option>
						<?php
						$penyusun2=DB::table('users')->get();
						?>
						@foreach($penyusun2 as $penyusun2)
						<option value="{{$penyusun2->id}}">{{$penyusun2->name}}</option>
						@endforeach
					</select>
				</div>
				
				<div class="form-line">
					<label for="exampleInputPassword1">File</label>
					<input type="file" class="form-control" name="file_laporan" onchange="validasiFile()" id="file" >
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



function validasiFile(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi doc/docx');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}

</script>
