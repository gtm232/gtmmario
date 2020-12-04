<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>MARIO</title>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/morris/morris.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/morris/examples/lib/example.js"></script>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">
	<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/morris/morris.css">
	<link rel="stylesheet" href="<?php echo URL::to('/'); ?>/catatan/jquery-ui.css">
    <!-- Favicon-->
    <link rel="icon" href="<?php echo URL::to('/'); ?>/aset/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/animate-css/animate.css" rel="stylesheet" />
	
	<!-- Bootstrap DatePicker Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
    
	<!-- JQuery DataTable Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo URL::to('/'); ?>/aset/css/style.css" rel="stylesheet">
	<link href="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
	  
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo URL::to('/'); ?>/aset/css/themes/all-themes.css" rel="stylesheet" />
	
	<script src="<?php echo URL::to('/'); ?>/tinymce/js/tinymce/tinymce.min.js" ></script>
	

</head>

<body class="theme-red" >

    @include('base.header')
    @include('base.sidebar')
    @include('base.isi')
    <!-- Jquery Core Js -->
   <!-- Jquery Core Js -->
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.0.385/build/pdf.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo URL::to('/'); ?>/signature/signature_pad-master/js/signature_pad.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="<?php echo URL::to('/'); ?>/aset/plugins/flot-charts/jquery.flot.pie.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/node-waves/waves.js"></script>
	<script src="<?php echo URL::to('/'); ?>/aset/plugins/raphael/raphael.min.js"></script>
	
	<!-- Autosize Plugin Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/autosize/autosize.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/js/admin.js"></script>
    <script src="<?php echo URL::to('/'); ?>/aset/js/pages/tables/jquery-datatable.js"></script>
	<script src="<?php echo URL::to('/'); ?>/js/bootstrap-datepicker.js"></script>
	
	<!-- Chart Plugins Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/plugins/chartjs/Chart.bundle.js"></script>
	
	<!-- Custom Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/Chart.js"></script>
	
    <!-- Demo Js -->
    <script src="<?php echo URL::to('/'); ?>/aset/js/demo.js"></script>
	
	<script src="<?php echo URL::to('/'); ?>/catatan/html2canvas.js"></script>
	<script src="<?php echo URL::to('/'); ?>/catatan/canvas2image.js"></script>
	<script src="<?php echo URL::to('/'); ?>/catatan/jquery-ui.js"></script>
	<script src="<?php echo URL::to('/'); ?>/catatan/jquery-touch.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Base64/0.3.0/base64.min.js"></script>
	
</body>

</html>
<script>

function simpan_dokumen_laporan_bulanan(){
	document.getElementById('tambah_dokumen_form').submit();
	window.setTimeout(refresh_simpan_dokumen_laporan_bulanan, 2000);
}

function refresh_simpan_dokumen_laporan_bulanan(){
	document.getElementById('back_dbln').submit();
}


function pms(value1,value2) {
	document.getElementById('id_laporan_pekerjaan').value =value1;
	document.getElementById('id_pembuatan_surat').value =value2;
	document.getElementById('pms').submit();
}

$(document).ready(function() {
                var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
					
				
                $('#ck').click(function(){
                   var id_histori = $(this).attr('id-histori');
				   $('#id_histori').val(id_histori);
                });
	
                $('#click').click(function(){
                    var data = signaturePad.toDataURL('image/png');
					var img_data = data.replace(/^data:image\/(png|jpg);base64,/, "");
                    $('#output').val(data);

                    $("#sign_prev").show();
                    //$("#sign_prev").attr("src",data);
					$("#ttd").fadeIn(1000);
                    // Send data to server instead...
                    //window.open(data);
                });
				
				document.getElementById('clear').addEventListener('click', function () {
				  signaturePad.clear();
				   $('#output').val("");
				   $("#ttd").fadeOut(1000);
				});
				
				
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
	
$(".tindak_lanjut").click(function(){
		var id_detail_mea = $(this).attr('id-detail-mea');
		var id_mea = $(this).attr('id-mea');
		var token = $(this).attr('token');
		var id_user = <?php echo Auth::user()->id; ?>;
		$.ajax({
			type: "post",
			data: "id_detail_mea=" + id_detail_mea + "&id_mea=" + id_mea + "&id_user=" + id_user + "&_token=" + token,
			url:"<?php echo url('/refresh_tindak_lanjut'); ?>",
			success:function(data){
				
					$("#tindaklanjut").html(data);
					$("#tindaklanjutmodal").modal();
			}
			
			});
		
		
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
	
	
</script>
