<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class acrue extends Model
{
    //
	protected $table ="acrue";
	
	protected $fillable = ['tahun','tanggal_mulai','tanggal_akhir'];
}
