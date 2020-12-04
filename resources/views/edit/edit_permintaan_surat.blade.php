@extends('base.app')
@section('content')

<div class="container">
		<div class="col-md-12">
			<!-- content -->
			<h2>Menu Add Data</h2>
			<form class="form-line" action="{{ route('permintaan_surat.update',$permintaan_surat->id) }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				{{ csrf_field() }}
				<div class="form-line">
					<label>Perihal Permintaan</label>
					  <input type="text" class="form-control" name="perihal_permintaan" value="{{$permintaan_surat->perihal_permintaan}}">
					
				</div>
				
				<div class="form-line">
					<?php
					$pekerjaan=DB::table('laporan_pekerjaan')->get();
					?>
					<label>Pilih Pekerjaan</label>
					<select name="pekerjaan" class="form-control" id="zoneSelect1" onchange="updateChar100();">
					<option>--Pilih--</option>
					@foreach($pekerjaan as $pekerjaan)
						<option value="{{$pekerjaan->id}}">{{$pekerjaan->nama_pekerjaan}}</option>
					@endforeach
					</select>
				</div>
				
				<div class="form-line">
					<div id="ps"></div>
				</div>
				
				<div class="form-line">
					<label>File</label>
					  <input type="file" class="form-control" name="file" onchange="validasiFile()" id="file" >
					  <input type="hidden" name="file_old" value="{{$permintaan_surat->file}}" id="file" >
				</div>
				<div class="form-line">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	
</div>
@endsection
<script>
function updateChar100() {
	
    var zone = document.getElementById("zoneSelect1");
//alert(zone.value);
	$.ajax({
			type: "post",
			data: "id=" + zone.value + "&_token={{csrf_token()}}",
			url:"<?php echo url('/refresh_permintaan_surat'); ?>",
			success:function(data){
				
					$("#ps").html(data);
			}
			
			});
}
function validasiFile(){
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi mp4');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}





</script>