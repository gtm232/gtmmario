<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls");
?>

<table border="1" >
        <thead>
            <tr>
                <th bgcolor="yellow">Klausul</th>
                <th bgcolor="yellow">Temuan</th>
                <th bgcolor="yellow">Yes</th>
                <th bgcolor="yellow">No</th>
                <th bgcolor="yellow">Rekomendasi Perbaikan</th>
                <th bgcolor="yellow">Due Date</th>
                <th bgcolor="yellow">PIC</th>
                <th bgcolor="yellow">Status</th>
				<th bgcolor="yellow">Dokumentasi</th>
            </tr>
        </thead>
            <?php
				$detail_mea=DB::table("detail_mea")->where('id_mea',$_GET["id_mea"])->get();
			?>
			@foreach($detail_mea as $detail_mea)
			<tr>
				<td align="center" valign="top">{{$detail_mea->klausul}}</td>
				<td align="center" valign="top">{{$detail_mea->temuan}}</td>
				<td align="center" valign="top">{{$detail_mea->yes}}</td>
				<td align="center" valign="top">{{$detail_mea->no}}</td>
				<td align="center" valign="top">{{$detail_mea->rekomendasi_perbaikan}}</td>
				<td align="center" valign="top" valign="top">{{date('d-M-Y',strtotime($detail_mea->duedate))}}</td>
				<td align="center" valign="top">{{$detail_mea->pic}}</td>
				<td align="center" valign="top">{{$detail_mea->status}}</td>
				<td height="40">
				@if($detail_mea->dokumentasi != null)
				<img style="margin-left:10px;" width="40" height="40" src="<?php echo url('/');?>/mea/gambar/{{$detail_mea->dokumentasi}}">
				@endif
				</td>
			</tr>
			@endforeach
	</table>