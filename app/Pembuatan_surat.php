<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembuatan_surat extends Model
{
    //
	protected $table ="pembuatan_surat";
	
	protected $fillable = ['nomor_surat','sifat','lampiran','perihal','tanggal_surat','tujuan','alamat','isi','status','jenis_dokumen','id_laporan_pekerjaan','namapic','no_urut','catatan'];
}
