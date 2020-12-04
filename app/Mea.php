<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mea extends Model
{
    //
	protected $table ="mea";
	 
	protected $fillable = ['tanggal','wilayah','lokasi','expired','status','pj1','pj2','penyusun1','penyusun2','file_laporan'];
}
