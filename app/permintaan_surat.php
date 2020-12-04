<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan_surat extends Model
{
    //
	protected $table ="permintaan_surat";
	
	protected $fillable = ['perihal_permintaan','file','catatan'];
}
