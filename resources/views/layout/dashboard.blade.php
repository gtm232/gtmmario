@extends('base.app')
@section('content')
	
<script src="<?php echo URL::to('/'); ?>/haightcart/code/highcharts.js"></script>
<script src="<?php echo URL::to('/'); ?>/haightcart/code/highcharts-3d.js"></script>
<script src="<?php echo URL::to('/'); ?>/haightcart/code/modules/exporting.js"></script>
<script src="<?php echo URL::to('/'); ?>/haightcart/code/modules/export-data.js"></script>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div id="container" style="height: 400px; "></div>
		
	</div>

<script type="text/javascript">


Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 30,
            beta: 0,
            depth: 100
        }
    },
    title: {
        text: 'ANGGARAN PEKERJAAN'
    },
    subtitle: {
        text: ''
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories:  [''],
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
		
		labels: {
            format:' '
        },
		
        title: {
            text: null
        }
    },
		series: [
	<?php
		$jml=0;
		$jenis_anggaran=DB::table('jenis_anggaran')->get();
		foreach($jenis_anggaran as $jenis_anggaran){
			$pekerjaan=DB::table('laporan_pekerjaan')->where('tahun',2020)->get();
			foreach($pekerjaan as $pekerjaan){
				$dokumen_pekerjaan=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$pekerjaan->id)->where('jenis_dokumen','SPK')->get()->first();
				$dokumen_pekerjaan1=DB::table('dokumen_laporan_pekerjaan')->where('id_laporan_pekerjaan',$pekerjaan->id)->where('jenis_dokumen','SPK')->count();
				
				
				
				if($dokumen_pekerjaan1 !=0){
				$harga=$dokumen_pekerjaan->harga;
				$spk_dev=DB::table('spk_dev')->where('id_dokumen',$dokumen_pekerjaan->id)->where('tahun',2020)->where('jenis_anggaran',$jenis_anggaran->id)->get()->first();
				$spk_dev1=DB::table('spk_dev')->where('id_dokumen',$dokumen_pekerjaan->id)->where('tahun',2020)->where('jenis_anggaran',$jenis_anggaran->id)->count();
				}
				
				if($spk_dev1 !=0){
				$jml2=($spk_dev->persentasi/100)*$harga;
				$jml=$jml2+$jml;
				}
			}
	?>	
		{
			name: '{{$jenis_anggaran->jenis_anggaran}}',
			data: [{{$jml}}]
		},
	
	<?php
	}
	?>
	
	]
});
		</script>
	
 @endsection