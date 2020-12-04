<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo URL::to('/'); ?>/gambar/logo.ico">
    <title>Mario</title>
	
	<!--script src="<?php echo URL::to('/'); ?>/ckeditor/ckeditor.js"></script-->
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo URL::to('/'); ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo URL::to('/'); ?>/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo URL::to('/'); ?>/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo URL::to('/'); ?>/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="<?php echo URL::to('/'); ?>/tinymce/js/tinymce/tinymce.min.js" ></script>



  
</head>

<body class="fix-header card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="javascript:">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img  style="width:60px; height:90px; " src="<?php echo URL::to('/'); ?>/gambar/logo.png" alt="homepage" class="dark-logo" />
                            
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span >
                         <!-- dark Logo text 
                         <img src="../assets/images/logo-text.png" alt="homepage" class="dark-logo" />-->
					
                         </span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                     <ul class="navbar-nav mr-auto mt-md-0 ">
                        <!-- This is  -->
						
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                       <div style="margin-left:15px; "><h1 style="color:white;"><b>SIM</b></h1></div>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: ;">
								{{ csrf_field() }}
								<button class="btn btn-danger" type="submit" >Logout</button>
								</form>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href="<?php echo url('/dashboard'); ?>" class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="<?php echo url('/bulanan'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>Laporan Bulanan</a>
                        </li>
                        <li>
                            <a href="<?php echo url('/pekerjaan'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>Order Of Communication</a>
                        </li>
						@if(Auth::user()->hak_akses == "admin")
						<li>
                            <a href="<?php echo url('/peringatan'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>Mendekati Jangka Waktu</a>
                        </li>
                        @endif
						<li>
                            <a href="<?php echo url('/suratsurat'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>Surat-Surat</a>
                        </li>
						
						@if(Auth::user()->hak_akses == "admin")
						<li>
                            <a href="<?php echo url('/user'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>Data User</a>
                        </li>
						
						<li>
                            <a href="<?php echo url('/acrue'); ?>" class="waves-effect"><i class="fa fa-folder m-r-10" aria-hidden="true"></i>acrue</a>
                        </li>
						@endif
					   
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                © Mario 2019
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
	
    <script src="<?php echo URL::to('/'); ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo URL::to('/'); ?>/assets/plugins/bootstrap/js/tether.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/datatables/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/js/demo/datatables-demo.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo URL::to('/'); ?>/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo URL::to('/'); ?>/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo URL::to('/'); ?>/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo URL::to('/'); ?>/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo URL::to('/'); ?>/js/custom.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/js/bootstrap-datepicker.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo URL::to('/'); ?>/assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>

<script>

$(".lihat_detail_mea").click(function(){
		
		var id_detail_mea = $(this).attr('id-detail-mea');
		var token = $(this).attr('token');
		
		$.ajax({
			type: "post",
			data: "id_detail_mea=" + id_detail_mea + "&_token=" + token,
			url:"<?php echo url('/refresh_detail_mea'); ?>",
			success:function(data){
				
					$("#lihat_detail_mea").html(data);
					$("#exampleModal3").modal();
			}
			});
		
		
	});

$("#wilayah").click(function(){
		
		var wilayah = $(this).val();
		if(wilayah == 'WOSS'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','WOSS')->get()->first();
				if($pjw){
					$pjw1=$pjw->name;
				}else{
					$pjw1="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGN").value = "{{$pjw1}}";
		}else if(wilayah == 'WOL'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','WOL')->get()->first();
				if($pjw){
					$pjw2=$pjw->name;
				}else{
					$pjw2="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGN").value = "{{$pjw2}}";
		}else if(wilayah == 'WOJBB'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','WOJBB')->get()->first();
				if($pjw){
					$pjw3=$pjw->name;
				}else{
					$pjw3="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGN").value = "{{$pjw3}}";
		}
		
	});
	
	
$("#lokasi").click(function(){
		
		var wilayah = $(this).val();
		if(wilayah == 'Stasiun Bojonegara'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Bojonegara')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Muara Bekasi'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Muara Bekasi')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Terbanggi Besar'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Terbanggi Besar')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Labuhan Maringgai'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Labuhan Maringgai')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Pagardewa'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Pagardewa')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Metering Pagardewa'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Metering Pagardewa')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Pagardewa'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Pagardewa')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Talang Duku'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Talang Duku')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Stasiun Grissik'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Stasiun Grissik')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 1'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 1')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 2'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 2')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 3'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 3')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 4'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 4')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 5'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 5')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}else if(wilayah == 'Section 6'){
			<?php
				$pjw=DB::table('users')->where('penanggung_jawab','Section 6')->get()->first();
				if($pjw){
					$pjw=$pjw->name;
				}else{
					$pjw="";
				}
			?>
			document.getElementById("PenanggungJawabPTPGASOL").value = "{{$pjw}}";
		}
		
	});
$('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });

$('#dataTable').dataTable( {
  "ordering": false
} );

$("#tgl").datepicker({
format: 'dd MM yyyy',
autoclose: true
});

$("#tgl2").datepicker({
format: 'dd MM yyyy',
autoclose: true
});

$("#tgl3").datepicker({
format: 'dd MM yyyy',
autoclose: true
});

$("#tgl10").datepicker({
format: 'dd MM yyyy',
autoclose: true
});

$("#tgl11").datepicker({
format: 'dd MM yyyy',
autoclose: true
});

var rupiah1 = document.getElementById("harga_kesepakatan");
rupiah1.addEventListener("keyup", function(e) {
  rupiah1.value = formatRupiah(this.value, "R. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah1 = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah1 += separator + ribuan.join(".");
  }

  rupiah1 = split[1] != undefined ? rupiah1 + "," + split[1] : rupiah1;
  return prefix == undefined ? rupiah1 : rupiah1 ? "Rp " + rupiah1 : "";
  
  
}

var rupiah = document.getElementById("harga_penawaran");
rupiah.addEventListener("keyup", function(e) {
  rupiah.value = formatRupiah(this.value, "R. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "Rp " + rupiah : "";
  
  
}

var rupiah5 = document.getElementById("harga_pekerjaan");
rupiah5.addEventListener("keyup", function(e) {
  rupiah5.value = formatRupiah(this.value, "R. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah5 = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah5 += separator + ribuan.join(".");
  }

  rupiah5 = split[1] != undefined ? rupiah5 + "," + split[1] : rupiah5;
  return prefix == undefined ? rupiah5 : rupiah5 ? "Rp " + rupiah5 : "";
  
  
}



var rupiah2 = document.getElementById("harga_db");
rupiah2.addEventListener("keyup", function(e) {
  rupiah2.value = formatRupiah(this.value, "R. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah2 = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah2 += separator + ribuan.join(".");
  }

  rupiah2 = split[1] != undefined ? rupiah2 + "," + split[1] : rupiah2;
  return prefix == undefined ? rupiah2 : rupiah2 ? "Rp " + rupiah2 : "";
  
  
}



</script>
