<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class perencanaan extends Model
{
    //
	protected $table ="perencanaan";
	
	protected $fillable = ['nama_pekerjaan','bulan','sampai_bulan','tahun'];
}
