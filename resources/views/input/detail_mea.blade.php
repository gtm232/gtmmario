@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Tambah MEA</h2>
			<form class="form-group" action="<?php echo url('/tambah_detail_mea_proses'); ?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<input type="hidden" name="id_mea" value="{{$id_mea}}">
				
				<div class="form-group">
					<label>Klausul</label>
					  <input type="text" class="form-control" name="klausul">
					
				</div>
				
				<div class="form-group">
					<label>Temuan</label>
					  <input type="text" class="form-control" name="temuan">
					
				</div>
				
				<div class="form-group">
					<label>Dokumentasi</label>
					  <input type="file" class="form-control" name="dokumentasi" onchange="validasiFile()" id="file" >
				</div>
				
				<div class="form-group">
					<label>Yes / no</label><br>
						<input name="yes" value="yes" type="radio" id="radio_1" checked />
                        <label for="radio_1">Yes</label>
                        <input name="yes" value="no" type="radio" id="radio_2" />
                        <label for="radio_2">No</label>
					
				</div>
				
				<div class="form-group">
					<label>Rekomendasi Perbaikan</label>
					  <textarea class="form-control" name="rekomendasi_perbaikan">
					  
					  </textarea>
				</div>
				
				<div class="form-group">
					<label >PIC</label>
					  <input type="text" class="form-control" name="pic">
					
				</div>
				
				<div class="form-group">
					<label>Due Date</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="duedate" value="<?php echo date('d F Y',strtotime (date("Y-m-d"))) ; ?>" readonly>
					
				</div>
				
				<div class="form-group">
					<label >Status</label>
					<select class="form-control" name="status">
						<option>--Pilih--</option>
						<option value="Open">Open</option>
						<option value="Closed">Closed</option>
					</select>
				</div>
				
				<div class="form-group">
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
    var ekstensiOk = /(\.png|\.PNG|\.|jpg|\.JPG|\.jpeg|\.JPEG)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi png/jpg');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}
</script>
