<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suratsurat extends Model
{
    //
	protected $table ="surat_surat";
	
	protected $fillable = ['id','no_surat','perihal','tanggal','lokasi','file','jenis_surat'];
}
