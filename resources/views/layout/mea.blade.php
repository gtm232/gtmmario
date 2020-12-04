@extends('base.app')
@section('content')


 <div class="row">
	       
        <div class="col-12">
            <div class="card">
                <div class="card-block">
        <div class="panel panel-primary filterable">
		
			<div class="panel-heading">
				<h1 align="center" class="panel-title">Mea</h1>
            </div>
			
			
			<br>
			
			<div style="margin-left:5px;" class="form-group">
				<select name="tahun" style="width:110px; margin-left:15px;" onchange="location = this.value;">
						  <option>Tahun</option>
						  <?php $tgl_aw=2018; $tgl_ak=date("Y"); 
						  for($i=$tgl_ak; $i>=$tgl_aw; $i--){
						  ?>
						  <option value="mea?thn={{$i}}">{{$i}}</option>
						  <?php } ?>
						  
				</select>
			</div>
		
		<div class="table-responsive" style="padding:0px 5px 0px 5px;">
			<div class="form-line">
				<a style="float:left; margin:5px 0px 5px 5px;" href="{{ route('mea.create') }}" ><button class="btn btn-info">Tambah</button></a>
			</div>
			
			<div class="pull-right" style="padding:5px; ">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
	  
            <table class="table table-bordered" >
                <thead>
                    <tr class="filters">
                        <th style="background-color:yellow; width:50px;"><input style=" color: white; background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="No" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Tanggal" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Wilayah" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Lokasi" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Expired" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Status" disabled></th>
                        <th width="130" style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Penyusun 1" disabled></th>
                        <th width="130" style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Penyusun 2" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="PGN" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="PGASOL" disabled></th>
                        <th style="background-color:yellow;"><input style=" background-color: transparent; border: none; cursor: auto; box-shadow: none; padding: 0; height: auto;" type="text" class="form-control" placeholder="Aksi" disabled></th>
                    </tr>
                </thead>
                <tbody>
				<?php
				if(isset ($_GET['thn'])){
					$thn=$_GET['thn'];
				}else{
					$thn=date("Y");
				}
				$mea=DB::table('mea')->whereYear('tanggal','=',$thn)->get();
				$no=1;
				?>
				@foreach($mea as $mea)
                    <tr>
                        <td>{{$no}}</td>
                        <td>{{date('d-M-Y',strtotime($mea->tanggal))}}</td>
                        <td>{{$mea->wilayah}}</td>
                        <td>{{$mea->lokasi}}</td>
                        <td>{{date('d-M-Y',strtotime($mea->expired))}}</td>
                        <td>{{$mea->status}}</td>
                        <td>
						<?php
						$penyusun1=DB::table('users')->where('id',$mea->penyusun1)->get()->first();
						?>
						{{$penyusun1->name}}
						</td>
                        <td>
						<?php
						$penyusun2=DB::table('users')->where('id',$mea->penyusun2)->get()->first();
						?>
						{{$penyusun2->name}}
						</td>
						
						<td>
						<?php
						$pj1=DB::table('users')->where('id',$mea->pj1)->get()->first();
						?>
						{{$pj1->name}}
						</td>
						<td>
						<?php
						$pj2=DB::table('users')->where('id',$mea->pj2)->get()->first();
						?>
						{{$pj2->name}}
						</td>
                        <td>
							<table >
							<tr>
								<td style="border-style: none;">
									<a href="javascript:" onclick="document.getElementById('detail_mea{{$no}}').submit()">
									<i class="material-icons">collections_bookmark</i>
									</a>
									<div style="display:none;">
									<form id="detail_mea{{$no}}" method="post" action="<?php echo url('/detail_mea'); ?>">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="text" name="id_mea" value="{{$mea->id}}">
										<input type="submit" class="btn btn-danger" value="detail_mea" />
									</form>
									</div>
								</td>
									
									
								<td style="border-style: none;">
									<a href="javascript:" onclick="document.getElementById('mea').submit()">
									<i class="material-icons">delete</i>
									</a>
									<div style="display:none;">
									<form id="mea" method="post" action="{{ route('mea.destroy',$mea->id) }}">
										<input type="hidden" name="_method" value="DELETE">
										<input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="submit" class="btn btn-danger" value="Delete" />
									</form>
									</div>
								</td>
							</tr>
							</table>
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