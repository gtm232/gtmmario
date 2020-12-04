@extends('base.app')
@section('content')
	<!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0">Surat-surat</h3>
                        
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
            
			<br>
			@if(Auth::user()->hak_akses == "admin")			
             <a style="margin:5px;" href="{{ route('suratsurat.create') }}" ><button class="btn btn-info">Tambah</button></a>
					<br>
            @endif
          
			
				<form style="float:left; margin:5px;" action="<?php echo url('/surat_masuk'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary">Surat Masuk</button></a>
				</form>
				
				<form style="float:left; margin:5px;" action="<?php echo url('/surat_keluar'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary">Surat Keluar</button></a>
				</form>
				
				<form style="float:left; margin:5px;" action="<?php echo url('/dokumen_pekerjaan_surat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<button type="submit" class="btn btn-primary">Pekerjaan</button></a>
				</form>
			<br>
			<br>
            <div class="card-body ">
              <div style="margin:5px;" class="table-responsive">
                  
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No Surat</th>
					  <th>Perihal</th>
                      <th>Tanggal</th>
					  <th>Jenis Surat</th>
					  <th>Lokasi Arsip</th>
                      @if(Auth::user()->hak_akses == "admin")
					  <th>Opsi</th>
					  @endif
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php $no=1; ?>
				  
				  @if(isset($suratsurat))
				  @foreach($suratsurat as $surat)
				   
                    <tr>
					  <td ><a href="javascript:" onclick="document.getElementById('suratsurat{{$no}}').submit()">{{$surat->no_surat}}</a></td>
					  <td ><a href="javascript:" onclick="document.getElementById('suratsurat{{$no}}').submit()">{{$surat->perihal}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('suratsurat{{$no}}').submit()">{{$surat->tanggal}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('suratsurat{{$no}}').submit()">{{$surat->jenis_surat}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('suratsurat{{$no}}').submit()">{{$surat->lokasi}}</a></td>
                      
					  <div style="display:none;">
					  <form id="suratsurat{{$no}}" action="<?php echo url('/lihatsuratsurat'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_suratsurat" value="{{$surat->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  @if(Auth::user()->hak_akses == "admin")
					  <td >
					 
					 <a  style="float:left; margin-right:5px;" href="{{ route('suratsurat.edit',$surat->id) }}"><button class="btn btn-primary">Edit</button></a>
				
					<form style="float:left; margin-right:5px;" method="post" action="{{ route('suratsurat.destroy',$surat->id) }}">
						<input type="hidden" name="_method" value="DELETE">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="file" value="{{ $surat->file }}">
						<input type="submit" class="btn btn-danger" value="Delete" />
					</form>
					  </td>
					  @endif
                    </tr>
					
					<?php $no++; ?>
					
					
                   @endforeach
				   @endif
				   
				   
				   @if(isset($dlp))
				  @foreach($dlp as $dlp)
				   <?php
				   $lokasi2=DB::table('laporan_pekerjaan')->Where('id','=',23)->get()->first();
				   ?>
                    <tr>
					  <td ><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()">{{$dlp->no_surat}}</a></td>
					  <td ><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()">{{$dlp->prihal}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()">{{$dlp->tanggal}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()">{{$dlp->jenis_dokumen}}</a></td>
                      <td ><a href="javascript:" onclick="document.getElementById('dbln{{$no}}').submit()">{{$lokasi2->lokasi}}</a></td>
                      
					 <div style="display:none;">
					<form id="dbln{{$no}}" action="<?php echo url('/lihat_dokumen_pekerjaan'); ?>" method="post">
						<input type="hidden" name="_token" value="{{csrf_token()}}">
						<input type="hidden" name="id_laporan_pekerjaan" value="{{$dlp->id_laporan_pekerjaan}}">
						<input type="hidden" name="id" value="{{$dlp->id}}">
						<button type="submit" class="btn btn-primary">save</button></a>
					</form>
					  </div>
					  @if(Auth::user()->hak_akses == "admin")
					  <td >
					 
					
					  </td>
					  @endif
                    </tr>
					
					<?php $no++; ?>
					
					
                   @endforeach
				   @endif
				   
				   
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

