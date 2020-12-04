<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class eproc extends Model
{
    //
	protected $table ="eproc";
	 
	protected $fillable = ['id_laporan_pekerjaan','nomor_po','nomor_receipt'];
}
