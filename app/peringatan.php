<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class peringatan extends Model
{
    //
	protected $table ="laporan_pekerjaan";
	
	protected $fillable = ['nama_pekerjaan','tanggal_mulai','tanggal_berakhir','lokasi','pic','status'];
}
