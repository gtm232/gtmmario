@extends('base.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-block">
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<form  style="" action="<?php echo url('/import1'); ?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="text" name="id_mea" value="{{$id_mea}}">
							<label for="file">Upload file {{$id_mea}}</label>
							<input type="file" class="form-control-file" name="file" id="file" placeholder="">
						  </div>
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="Submit" class="btn btn-primary">Save changes</button>
							
						  </div>
					  </form>
					</div>
				  </div>
			</div>
			
			<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog" role="document">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Lihat Detail</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						<div id="lihat_detail_mea">
						
						</div>
					  </div>
						  
						  <div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						  </div>
					</div>
				  </div>
			</div>
			
			<div class="modal fade" id="tindaklanjutmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													  <span aria-hidden="true">&times;</span>
													</button>
												  </div>
												  <div class="modal-body">
													<form id="detail_mea" style="" action="{{url('/tindak_lanjut')}}" method="post" enctype="multipart/form-data">
													<div id="tindaklanjut"></div>
													<div class='form-line'>
													<label>Tanggal Closing</label>
													<input style="background:#ffff;" type="text" class="form-control" id="tgl" autocomplete="off" name="tgl" value="{{date('d F Y',strtotime (date('Y-m-d')))}}" readonly>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="Submit" class="btn btn-primary">Save changes</button>
													</div>
													</form>	
													<script>
													$('#tg').datepicker({
													format: 'dd MM yyyy',
													autoclose: true
													});
			
													</script>
												  </div>
											     </div>
											  </div>
			</div>	
			
				<div class="card-body " style="margin">
				<br>
				<a style="float:left; margin:5px;" href="javascript:" onclick="document.getElementById('detail_mea2').submit()" ><i class="fa fa-plus" style="background:blue; color:white; padding:5px; border-radius: 5px;">&nbsp;Tambah Rekomendasi</i></a>
				<form id="detail_mea2" style="display:none; " action="<?php echo url('/tambah_detail_mea'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_mea" value="{{$id_mea}}">
						<button type="submit" class="btn btn-info">Tambah</button></a>
				</form>
				
				<a href="<?php echo URL::to('/'); ?>/mea/template.xlsx">
							<button type="Submit" class="btn btn-primary">Download Template</button>
							</a>
				
				<a style="float:left; margin:5px;" href="javascript;" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-cloud-upload" style="background:#1dced6; color:white; padding:5px; border-radius: 5px;">&nbsp;Import Data</i></a>
				
				<a style="float:left; margin:5px;" href="<?php echo url('/'); ?>/export?id_mea={{$id_mea}}" ><i class="fa fa-cloud-download" style="background:green; color:white; padding:5px; border-radius: 5px;">&nbsp;Export Data</i></a>
				<div style="clear:both; margin-bottom:10px;"></div>
						<div class="table-responsive" style="margin:5px;">
							<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							  <thead>
								<tr>
								  <th>No</th>
								  <th>Klausul</th>
								  <th>Temuan</th>
								  <th>Dokumentasi</th>
								  <th>Yes</th>
								  <th>No</th>
								  <th>Rekomendasi Perbaikan</th>
								  <th>Due Date</th>
								  <th>PIC</th>
								  <th>Status</th>
								  <th>Opsi</th>
								</tr>
								
							  </thead>
							  
							  <tbody>
								<?php
								$detail_mea=DB::table('detail_mea')->where('id_mea',$id_mea)->get();
								$no=1;
								?>
								@foreach($detail_mea as $detail_mea)
								<tr>
								
								  <td>{{$no}}</td>
								  <td>{{$detail_mea->klausul}}</td>
								  <td>{{$detail_mea->temuan}}</td>
								  <td>
								  @if($detail_mea->dokumentasi != null)
									  <a href="<?php echo URL::to('/'); ?>/mea/gambar/{{$detail_mea->dokumentasi}}">
									  <img align="center" width="60" height="60" src="<?php echo URL::to('/'); ?>/mea/gambar/{{$detail_mea->dokumentasi}}"> 
									  </a>
								  @else
									<a style="float:left; margin:5px;" href="javascript:" onclick="document.getElementById('edit_detail_mea{{$no}}').submit()" ><i class="fa fa-plus" style="">Silahkan Upload Gambar</i></a>
									<form id="edit_detail_mea{{$no}}" style="display:none; " action="<?php echo url('/edit_detail_mea'); ?>" method="post">
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<input type="hidden" name="id_mea" value="{{$id_mea}}">
											<input type="hidden" name="id_detail_mea" value="{{$detail_mea->id}}">
											<button type="submit" class="btn btn-info">Tambah</button></a>
									</form>
								  @endif
								  </td>
								  <td>
								  @if($detail_mea->yes == "v")
									V
								  @endif
								  </td>
								  <td>
								  @if($detail_mea->no == "v")
									V
								  @endif
								  </td>
								  <td>{{$detail_mea->rekomendasi_perbaikan}}</td>
								  <td>{{date('d-M-Y',strtotime($detail_mea->duedate))}}</td>
								  <td>{{$detail_mea->pic}}</td>
								  <td>{{$detail_mea->status}}</td>
								  <td>
									<a style="float:left; margin:5px;" href="javascript:" onclick="document.getElementById('hapus_detail_mea{{$no}}').submit()" ><i class="material-icons">delete</i></a>
									<form id="hapus_detail_mea{{$no}}" style="display:none; " action="<?php echo url('/hapus_detail_mea'); ?>" method="post">
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<input type="hidden" name="id" value="{{$detail_mea->id}}">
											<input type="hidden" name="id_mea" value="{{$detail_mea->id_mea}}">
											<button type="submit" class="btn btn-info">Tambah</button></a>
									</form>
									<a style="float:left; margin:5px;" href="javascript:" onclick="document.getElementById('edit_detail_mea{{$no}}').submit()" ><i class="material-icons">create</i></a>
									<form id="edit_detail_mea{{$no}}" style="display:none; " action="<?php echo url('/edit_detail_mea'); ?>" method="post">
											<input type="hidden" name="_token" value="{{csrf_token()}}">
											<input type="hidden" name="id_mea" value="{{$id_mea}}">
											<input type="hidden" name="id_detail_mea" value="{{$detail_mea->id}}">
											<button type="submit" class="btn btn-info">Tambah</button></a>
									</form>
									
									@if($detail_mea->status == "Open" or $detail_mea->tindak_lanjut == null)
									<a style="float:left; margin:5px;" class="tindak_lanjut" href="javascript:" token="{{csrf_token()}}" id-detail-mea="{{$detail_mea->id}}" id-mea="{{$detail_mea->id_mea}}"><i class="material-icons">note_add</i></a>
									
									@endif
									
									@if($detail_mea->status == "Closed" and $detail_mea->tindak_lanjut != null)
									<a style="float:left; margin:5px;" class="lihat_detail_mea" href="javascript:" token="{{csrf_token()}}" id-detail-mea="{{$detail_mea->id}}"><i class="material-icons">remove_red_eye</i></a>
									
									@endif
								  </td>
							
								</tr>
								
								
									
								<?php
								$no++;
								?>
								@endforeach
							  </tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script>

			

function validasiFil(){
    var inputFile = document.getElementById('fil');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.png|\.PNG|\.jpg|\.JPG|\.jpeg|\.JPEG)$/i;
    if(!ekstensiOk.exec(pathFile)){
        alert('Silakan upload file yang memiliki ekstensi doc/docx');
        inputFile.value = '';
        return false;
    }else{
        //Pratinjau gambar
        
    }
}

function updateChar() {
	
    var zone = document.getElementById("zoneSelect2");

    if (zone.value == "Open"){
		document.getElementById("rr").value = "Open";
    }else if (zone.value == "Closed"){
		document.getElementById("rr").value = "Closed";
	}
}
</script>

