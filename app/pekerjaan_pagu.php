<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pekerjaan_pagu extends Model
{
    //
	protected $table ="laporan_pekerjaan_pagu";
	
	protected $fillable = ['nama_pekerjaan','lokasi','pic','status','wilayah_operasi','tahun'];
}
