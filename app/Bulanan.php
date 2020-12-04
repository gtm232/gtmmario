<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulanan extends Model
{
    //
	protected $table ="laporan_bulanan";
	
	protected $fillable = ['bulan','tahun','arsip'];
}
