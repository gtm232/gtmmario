@extends('base.app')
@section('content')

	<div class="row">
	<h2 align="center">Tambah Data</h2><br>
		<div class="col-md-12">
			<!-- content -->
			
			<form class="form-line" action="{{ route('pekerjaan.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="form-line">
					<label for="isi">Nama Pekerjaan</label>
					<input type="text" name="nama_pekerjaan" class="form-control" required="required">
				</div>
				
				<?php
					if(Auth::user()->hak_akses ==  "admin"){
				?>
				<div class="form-line">
					<label for="isi">Lokasi Arsip</label>
					<input type="text" name="lokasi" class="form-control" required="required">
				</div>
				<?php
					}else{
				?>
				
				<input type="hidden" name="lokasi" value="Belum Arsip">
				
				<?php } ?>
				
				<?php
					if(Auth::user()->hak_akses ==  "admin"){
				?>
				<div class="form-line">
					<label for="isi">PIC</label>
					<select name="pic" class="form-control" required="required">
						<?php
						$pic=DB::table('users')->where('hak_akses','=','user')->get();
						?>
						<option value="">--Pilih--</option> 
						@foreach($pic as $pic)
						<option value="{{$pic->id}}">{{$pic->name}}</option>
						@endforeach
					</select>
				</div>
				<?php
					}else{
				?>
				
				<input type="hidden" name="pic" value="{{Auth::user()->id}}">
				
				<?php } ?>
				
				
				<div class="form-line">
					<label for="isi">Wilayah Operasi</label>
					<input type="text" name="wilayah_operasi" class="form-control" required="required">
				</div>
				
				<div class="form-line">
					<label for="isi">Jenis Pekerjaan</label>
					<?php
						$jenis_pekerjaan=DB::table('jenis_pekerjaan')->get();
					?>
					<select name="jenis_pekerjaan" class="form-control" required="required">
						<option value="">--Pilih--</option>
						@foreach($jenis_pekerjaan as $jenis_pekerjaan)
							<option value="{{$jenis_pekerjaan->id}}">{{$jenis_pekerjaan->jenis_pekerjaan}}</option>
						@endforeach
					</select>
				</div>
			
			<div class="form-line" >
					<label>Tahun</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tahun" autocomplete="off" name="tahun" value="<?php echo date('Y') ; ?>" >
					
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
function updateChar() {
	
    var zone = document.getElementById("zoneSelect");

    if (zone.value == "Usulan"){
		document.getElementById("prihal").value = "Usulan ";
	}else if (zone.value == "SPPH"){
		document.getElementById("prihal").value = "Surat Permintaan Penawaran Harga ";
	}
}

function validasiFile(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi PDF');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}
</script>