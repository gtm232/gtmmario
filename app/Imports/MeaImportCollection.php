<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Auth; 

class MeaImportCollection implements ToCollection
{
    public function collection(Collection $rows )
    {
		$vidm=DB::table('verifikasi_id_mea')->where('id_user',Auth::user()->id)->get()->first();
		$no=1;
        foreach ($rows as $row) 
        {
			if($no > 1){
            DB::table('detail_mea')->insert([
				'id_mea' => $vidm->id_mea,
				'klausul' => $row[0],
				'temuan' => $row[1],
				'yes' => $row[2],
				'no' => $row[3],
				'rekomendasi_perbaikan' => $row[4],
				'pic' => $row[5],
				'duedate' => date('Y-m-d',strtotime($row[6])),
				'status' => "Open",
				//'tanggal_closing' => date('Y-m-d',strtotime($row[8])),
				//'tindak_lanjut' => $row[9],
			]);
			}
			$no++;
        }      
		DB::table('verifikasi_id_mea')->where('id_user', '=', Auth::user()->id)->delete();
    }
}