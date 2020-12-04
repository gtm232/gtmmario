@extends('base.app')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<!-- content -->
			<h2>Edit Data</h2>
			<form class="form-group" action="<?php echo url('/edit_dokumen_bulanan_proses'); ?>" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				
				<?php $bln = DB::table('dokumen_laporan_bulanan')->where('id', '=', $id)->get()->first(); ?>
				
					<input type="hidden" name="id_laporan_bulanan" class="form-control" value="{{$id_laporan_bulanan}}">
					<input type="hidden" name="id_jenis_laporan" class="form-control" value="{{$id_jenis_laporan}}">
					<input type="hidden" name="id_wilayah_operasi" class="form-control" value="{{$id_wilayah_operasi}}">
					<input type="hidden" name="id" class="form-control" value="{{$id}}">
				
				
				<div class="form-group">
					<label for="isi">Perihal</label>
					<input type="text" name="prihal" class="form-control" value="{{$bln->prihal}}" required="required">
				</div>
				
				<div class="form-group">
					<label for="exampleInputPassword1">File ( Kosongkan Jika Tidak dirubah )</label>
					<input type="file" class="form-control" name="file" onchange="validasiFile2()" id="file" >
					<input type="text" class="form-control" name="file_old"  value="{{$bln->nama_dokumen_laporan}}" >
				</div>
				
				<div class="form-group" style="<?php if(Auth::user()->hak_akses != 'admin'){ echo 'display:none;'; }?>">
					<label class="col-sm-4 control-label">Tanggal</label>
					  <input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tanggal" value="<?php echo date('d F Y',strtotime ($bln->tanggal)) ; ?>" readonly>
					
				</div>
				
				<div class="form-group">
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	
	
@endsection

<script>
function validasiFile2(){
	 
    var inputFile = document.getElementById('file');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.pdf|\.PDF)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi PDF');
        inputFile.value = '';
        return false;
    }else{
        var file_size = $('#file')[0].files[0].size;
	 if(file_size>32000000) {
	  alert('File maksimal 30 mb, Silahkan Potong Jadi Beberapa Bagian');
	  inputFile.value = '';
	  return false;
	 } 
        
    }
}
</script>