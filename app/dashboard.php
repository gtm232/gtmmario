<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    //
	protected $table ="laporan_pekerjaan";
	
	protected $fillable = ['nama_pekerjaan','tanggal_mulai','tanggal_berakhir','lokasi','pic','status','lokasi_pekerjaan','area_operasi','inisiator_kerja'];
}
