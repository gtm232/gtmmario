<?php
	
	

	
	$listitemobj=new list_item("",false);
	$listitem=$listitemobj->get_cart("item_list");
	$listitem_2=$listitemobj->get_cart("item_history");	
	$tgl=date('Y');
	
	
	
?>



		<script type="text/javascript">

Highcharts.chart('container4', {
     credits: {
    enabled: false
  },
	chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: ''
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
        categories: [
		<?php 
	
	
	foreach ($listitem as $row) {
	$dat=$row['tahun'];
	?>
		
		<?php
if($dat!=$tgl){
		echo $dat
		?>,
<?php } } echo $tgl;?>
		],
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: null
        }
    },
     series: [
	
	{
		
        name: 'Stock',
        data: 
		
		[
		<?php 
	foreach ($listitem as $row) {
	$dat=$row['tahun'];
	
	
	$sql=" SELECT  SUM(IF( YEAR(date) =" . $dat . ", saldo, 0)) AS jml
				FROM item_list ";
	$listitem2=$listitemobj->jumlah_pemasukan($sql);
	?>
		<?php echo $listitem2 ?>,
	<?php } ?>
		
		],
		
        stack: 'male'
    },
	
	{
		
        name: 'Pengeluaran',
		color:'yellow',
        data: 
		
		[
		<?php 
	foreach ($listitem_2 as $row) {
	$dat=$row['tahun'];
	
	
	$sql=" SELECT  SUM(IF( YEAR(date) =" . $dat . ", saldo, 0)) AS jml
				FROM item_history WHERE keterangan_persedian = 1 ";
	$listitem2=$listitemobj->jumlah_pemasukan($sql);
	?>
		<?php echo $listitem2 ?>,
	<?php } ?>
		
		],
		
        stack: 'male'
    },
	
	{
		
        name: 'Pemasukan',
        color: 'green',
		data: 
		
		[
		<?php 
	foreach ($listitem_2 as $row) {
	$dat=$row['tahun'];
	
	
	$sql=" SELECT  SUM(IF( YEAR(date) =" . $dat . ", saldo, 0)) AS jml
				FROM item_history WHERE keterangan_persedian = 2 ";
	$listitem2=$listitemobj->jumlah_pemasukan($sql);
	?>
		<?php echo $listitem2 ?>,
	<?php } ?>
		
		],
		
        stack: 'male'
    },
	
	
	
	
	]
});
		</script>
	
