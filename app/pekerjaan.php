<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pekerjaan extends Model
{
    //
	protected $table ="laporan_pekerjaan";
	
	protected $fillable = ['nama_pekerjaan','lokasi','pic','status','wilayah_operasi','jenis_pekerjaan','tahun'];
}
