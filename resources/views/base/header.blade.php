<div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">Sistem Informasi MARIO</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search 
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                    <!-- Notifications -->
                    <li class="dropdown">
					<?php
								
								$notif_mea=DB::table('detail_mea')->get();
								$no=1;
							?>
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">notifications</i>
							<?php
							$npsc=DB::table('history')->where([['status','belum'],['penerima',Auth::user()->id],])->count();
							$nps=DB::table('history')->where([['status','belum'],['penerima',Auth::user()->id],])->get();
							$pms=DB::table('pembuatan_surat')->get();
							$pms=DB::table('pembuatan_surat')->get();
							$hlpc=DB::table('notif_pelaporan')->where('id_users',Auth::user()->id)->count();
							$hlp=DB::table('notif_pelaporan')->where('id_users',Auth::user()->id)->get();
							?>
                            <span class="label-count">{{$npsc + $hlpc}}</span>
                        </a>
                        <ul class="dropdown-menu">
							
                            <li class="header">NOTIFICATIONS</li>
                            <li class="body">
                                <ul class="menu">
								<!--
									@foreach($notif_mea as $notif_mea)
									<?php
									//$mi=DB::table('mea')->where('id',$notif_mea->id_mea)->get()->first();
									?>
									@if($notif_mea->notifikasi == "BBS")
										
										@if($mi->penyusun1 == Auth::user()->id  or $mi->penyusun2 == Auth::user()->id)
										<?php	
										//if($mi->penyusun1 == Auth::user()->id){
											//$tanda=1;
										//}else if($mi->penyusun2 == Auth::user()->id){
										//	$tanda=2;
										//}
										?>	
											<li>
												<a href="javascript:" onclick="document.getElementById('notif{{$no}}').submit()">
													<div class="icon-circle bg-light-green">
														<i class="material-icons">comment</i>
													</div>
													<div class="menu-info">
														<h4>{{$notif_mea->temuan}}</h4>
													  
													</div>
												</a>
												
												<div style="display:none;">
													<form id="notif{{$no}}" action="<?php //echo url('/notifikasi'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_mea" value="{{$notif_mea->id_mea}}">
														<input type="hidden" name="id_detail_mea" value="{{$notif_mea->id}}">
														<input type="hidden" name="tanda" value="{{$tanda}}">
														<input type="hidden" name="status" value="BBS">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
											</li>
										@endif
										
									@elseif($notif_mea->notifikasi == "BS1")
									
										@if($notif_mea->status_penindaklanjut == "BB")
											<li>
												<a href="javascript:" onclick="document.getElementById('notif{{$no}}').submit()">
													<div class="icon-circle bg-light-green">
														<i class="material-icons">comment</i>
													</div>
													<div class="menu-info">
														<h4>{{$notif_mea->temuan}}</h4>
													 
													</div>
												</a>
												
												<div style="display:none;">
													<form id="notif{{$no}}" action="<?php //echo url('/notif_penindaklanjut'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_mea" value="{{$notif_mea->id_mea}}">
														<input type="hidden" name="id_detail_mea" value="{{$notif_mea->id}}">
														<input type="hidden" name="status_penindaklanjut" value="SB">
														
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
											</li>
										@endif
									
									@elseif($notif_mea->notifikasi == "BS2")
									
										@if($mi->penyusun2 == Auth::user()->id)
											<li>
												<a href="javascript:" onclick="document.getElementById('notif{{$no}}').submit()">
													<div class="icon-circle bg-light-green">
														<i class="material-icons">comment</i>
													</div>
													<div class="menu-info">
														<h4>{{$notif_mea->temuan}}</h4>
													   
													</div>
												</a>
												
												<div style="display:none;">
													<form id="notif{{$no}}" action="<?php //echo url('/notifikasi'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_mea" value="{{$notif_mea->id_mea}}">
														<input type="hidden" name="id_detail_mea" value="{{$notif_mea->id}}">
														<input type="hidden" name="tanda" value="2">
														<input type="hidden" name="status_" value="BS2">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
											</li>
										@endif
									@endif
									
									@if($notif_mea->penindak_lanjut == Auth::user()->id)
									
										@if($notif_mea->status_penindaklanjut == "BB")
											<li>
												<a href="javascript:" onclick="document.getElementById('notif2{{$no}}').submit()">
													<div class="icon-circle bg-light-green">
														<i class="material-icons">comment</i>
													</div>
													<div class="menu-info">
														<h4>{{$notif_mea->temuan}}</h4>
													   
													</div>
												</a>
												
												<div style="display:none;">
													<form id="notif2{{$no}}" action="<?php //echo url('/notif_penindaklanjut'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_mea" value="{{$notif_mea->id_mea}}">
														<input type="hidden" name="id_detail_mea" value="{{$notif_mea->id}}">
														<input type="hidden" name="id_user" value="{{Auth::user()->id}}">
														<input type="hidden" name="status_penindaklanjut" value="SB">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
											</li>
									
										@endif
									@endif
									
									
									<?php //$no++; ?>
                                   @endforeach --> 
								   
								   @foreach($nps as $nps)
								   <?php
								   $noo=1;
								   ?>
										<li>
												<a href="javascript:" onclick="document.getElementById('nps{{$noo}}').submit()">
													<div class="icon-circle bg-light-green">
													<?php
													$nh=DB::table('pembuatan_surat')->where('id',$nps->id_pembuatan_surat)->get()->first();
													?>
														<i class="material-icons"><i class="material-icons">alarm</i></i>
													</div>
													<div class="menu-info">
														<h4>{{$nh->perihal}}</h4>
													   <!-- <p>
															<i class="material-icons">access_time</i> 14 mins ago
														</p> -->
													</div>
												</a>
												
												<div style="display:none;">
													<form id="nps{{$noo}}" action="<?php echo url('/notif_histori'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_laporan_pekerjaan" value="{{$nh->id_laporan_pekerjaan}}">
														<input type="hidden" name="id" value="{{$nps->id}}">
														<input type="hidden" name="id_pembuatan_surat" value="{{$nh->id}}">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
											</li>
									<?php $noo++; ?>
									@endforeach
									
									@foreach($pms as $pms)
									<?php
									$nooo=1;
									$pic_pekerjaan=DB::table('laporan_pekerjaan')->where('id',$pms->id_laporan_pekerjaan)->get()->first();
									?>
									@if($pms->status == "Open" and $pic_pekerjaan->pic == Auth::user()->id)
									<li>
												<a href="javascript:" onclick="pms({{$pms->id_laporan_pekerjaan}},{{$pms->id}})">
													<div class="icon-circle bg-light-green">
													
														<i class="material-icons"><i class="material-icons">alarm</i></i>
													</div>
													<div class="menu-info">
														<h4>{{$pms->perihal}}</h4>
													   <!-- <p>
															<i class="material-icons">access_time</i> 14 mins ago
														</p> -->
													</div>
												</a>
												
												
									</li>
									
									@elseif($pms->status == "Cek Koordinator" and Auth::user()->hak_akses == "Koordinator")
									<li>
												<a href="javascript:" onclick="pms({{$pms->id_laporan_pekerjaan}},{{$pms->id}})">
													<div class="icon-circle bg-light-green">
													
														<i class="material-icons"><i class="material-icons">alarm</i></i>
													</div>
													<div class="menu-info">
														<h4>{{$pms->perihal}}</h4>
													   <!-- <p>
															<i class="material-icons">access_time</i> 14 mins ago
														</p> -->
													</div>
												</a>
												
									</li>
									
									@elseif($pms->status == "Open" and $pms->status != "Ok" and Auth::user()->hak_akses == "admin")
									<li>
												<a href="javascript:" onclick="pms({{$pms->id_laporan_pekerjaan}},{{$pms->id}})">
													<div class="icon-circle bg-light-green">
													
														<i class="material-icons"><i class="material-icons">alarm</i></i>
													</div>
													<div class="menu-info">
														<h4>{{$pms->perihal}}</h4>
													   <!-- <p>
															<i class="material-icons">access_time</i> 14 mins ago
														</p> -->
													</div>
												</a>
												
												
									</li>
									@endif
									
									<div style="display:none;">
													<form id="pms" action="<?php echo url('/pembuatan_surat'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" id="id_laporan_pekerjaan" name="id_laporan_pekerjaan" value="">
														<input type="hidden" id="id_pembuatan_surat" name="id_pembuatan_surat" value="">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
									</div>
									<?php $nooo++; ?>
									@endforeach
									
									<?php
									$hlpn=1;
									?>
									@foreach($hlp as $hlp)
									
										<li>
												<a href="javascript:" onclick="document.getElementById('hlp{{$hlpn}}').submit()">
													<div class="icon-circle bg-light-green">
													
														<i class="material-icons"><i class="material-icons">alarm</i></i>
													</div>
													<?php
													$lpp=DB::table('laporan_bulanan')->where('id',$hlp->id_laporan_bulanan)->get()->first();
													?>
													 
													<div class="menu-info">
														<h4>Laporan Bulan  
													  @if($lpp->bulan == 1)
														Januari
													  @elseif($lpp->bulan == 2)
														Februari
													  @elseif($lpp->bulan == 3)
														Maret
													  @elseif($lpp->bulan == 4)
														April
													  @elseif($lpp->bulan == 5)
														Mei
													  @elseif($lpp->bulan == 6)
														Juni
													  @elseif($lpp->bulan == 7)
														Juli
													  @elseif($lpp->bulan == 8)
														Agustus
													  @elseif($lpp->bulan == 9)
														September
													  @elseif($lpp->bulan == 10)
														Oktober
													  @elseif($lpp->bulan == 11)
														November
													  @elseif($lpp->bulan == 12)
														Desember
													  @endif
														</h4>
													   <!-- <p>
															<i class="material-icons">access_time</i> 14 mins ago
														</p> -->
													</div>
												</a>
												
												<div style="display:none;">
													<form id="hlp{{$hlpn}}" action="<?php echo url('/wilayah_operasi'); ?>" method="post">
														<input type="hidden" name="_token" value="{{csrf_token()}}">
														<input type="hidden" name="id_laporan_bulanan" value="{{$hlp->id_laporan_bulanan}}">
														<input type="hidden" name="id_notif" value="{{$hlp->id}}">
													<button type="submit" class="btn btn-primary">save</button></a>
													</form>
												</div>
									</li>
									<?php
									$hlpn++;
									?>
									@endforeach
                                </ul>
                            </li>
                            <li class="footer">
                                <!--<a href="javascript:void(0);">View All Notifications</a>-->
                            </li>
                        </ul>
                    </li>
                    <!-- #END# Notifications -->
                    <!-- Tasks 
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                            <i class="material-icons">flag</i>
                            <span class="label-count">9</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">TASKS</li>
                            <li class="body">
                                <ul class="menu tasks">
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Footer display issue
                                                <small>32%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-pink" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 32%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Make new buttons
                                                <small>45%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-cyan" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Create new dashboard
                                                <small>54%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-teal" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 54%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Solve transition issue
                                                <small>65%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-orange" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">
                                            <h4>
                                                Answer GitHub questions
                                                <small>92%</small>
                                            </h4>
                                            <div class="progress">
                                                <div class="progress-bar bg-purple" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 92%">
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer">
                                <a href="javascript:void(0);">View All Tasks</a>
                            </li>
                        </ul>
                    </li>
                     #END# Tasks
                    <li class="pull-right"><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="material-icons">more_vert</i></a></li>
                 --></ul>
            </div>
        </div>
    </nav>