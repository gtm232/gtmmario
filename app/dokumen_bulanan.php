<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dokumen_bulanan extends Model
{
    //
	protected $table ="dokumen_laporan_bulanan";
	
	protected $fillable = ['nosurat_dokumen','prihal','nama_penerima','id_laporan_bulanan','nama_dokumen_laporan','tanggal'];
}
