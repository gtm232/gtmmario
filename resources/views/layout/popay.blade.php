@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-12 col-12 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">POPAY</h3>
                        
                    </div>
                   
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-block">
            
          
            <div class="card-body ">
			
              <div class="table-responsive" style="margin:10px;">
                 @if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pic->pic)
			
				<form style="margin:10px 0px 10px 0px;" action="<?php echo url('/popay'); ?>" method="post">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<input type="hidden" name="id_spk_dev" value="{{$id_spk_dev}}">
							<input type="hidden" name="harga" value="{{$harga}}">
							<button type="submit" class="btn btn-primary">Tambah</button></a>
				</form>
					
            @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nomor Pr</th>
					  <th>Tanggal Input</th>
                      <th>Rupiah</th>
					  <th>Status</th>
					  <th>Opsi</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; 
				  $popaylist=DB::table('popay')->where('id_spk_dev',$id_spk_dev)->get();
				  ?>
				  @foreach($popaylist as $popaylist)
				   
                    <tr>
					  <td>{{$popaylist->nomor_pr}}</td>
					  <td>{{date('d F Y',strtotime ($popaylist->tanggal_input))}}</td>
					  <td>Rp. {{number_format($popaylist->rupiah,2,',','.')}}</td>
					  <td>
						@if($popaylist->status == "Paid")
							{{$popaylist->status}} Pada Tanggal {{date('d F Y',strtotime ($popaylist->tanggal_paid))}}
						@else
							{{$popaylist->status}}
						@endif
					  </td>
					
					  @if(Auth::user()->hak_akses == "admin" or Auth::user()->id == $pic->pic)
					  <td>
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('hapus{{$no}}').submit()"><i class="material-icons">delete</i></a> 
							<form id="hapus{{$no}}" style="display:none; float:left; margin-right:5px;" action="<?php echo url('/popay_hapus'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$popaylist->id}}">
								<input type="hidden" name="harga" value="{{$harga}}">
								<input type="hidden" name="id_spk_dev" value="{{$id_spk_dev}}">
								<button type="submit" class="btn btn-danger">Hapus</button></a>
							</form>
							
							<a style="float:left; margin-right:5px;" href="javascript:" onclick="document.getElementById('popay{{$no}}').submit()"><i class="material-icons">local_atm</i></a>
							<form id="popay{{$no}}" style="display:none; float:left;" action="<?php echo url('/popay_paid'); ?>" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="id" value="{{$popaylist->id}}">
								<input type="hidden" name="harga" value="{{$harga}}">
								<input type="hidden" name="id_spk_dev" value="{{$id_spk_dev}}">
								<button type="submit" class="btn btn-success">Paid</button></a>
							</form>
					  </td>
					  @endif
                    </tr>
					
					<?php $no++; ?>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
         
							   
							   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
@endsection

