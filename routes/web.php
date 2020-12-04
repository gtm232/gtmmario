<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
}); 
Route::get('email','EmailController@sendEmail');
Route::get('emails','EmailController@sendEmailsetiaphari');
Route::post('print_dokumen','EmailController@print_dokumen');
Route::post('print_doc','EmailController@print_doc');
Auth::routes();

 

Route::get('/home', 'DashboardController@index')->name('home');

Route::group(['middleware'=>'auth'], function() { 
    
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared"; 
});    
Route::resource('mea','MeaController');
Route::resource('dashboard','DashboardController');
Route::resource('acrue','AcrueController');
Route::resource('bulanan','BulananController');
Route::resource('pekerjaan','PekerjaanController');
Route::resource('pekerjaan_pagu','Pekerjaan_paguController');
Route::resource('perencanaan','PerencanaanController');
Route::resource('jenis_pekerjaan','Jenis_pekerjaanController');
Route::resource('jenis_anggaran','Jenis_anggaranController');
Route::post('pekerjaan_accrue','PekerjaanController@pac');
Route::post('pekerjaan_cari','PekerjaanController@pekerjaan_cari');

//tanda terima
Route::post('tanda_terima','BulananController@tanda_terima');
Route::post('statustandaterima','Dokumen_bulananController@statustandaterima');

//Route::post('pekerjaan','PekerjaanController@index');
Route::resource('peringatan','PeringatanController');
Route::resource('suratsurat','SuratsuratController');
Route::resource('user','UsersController');
Route::resource('pembuatan_surat','Pembuatan_suratController');
Route::resource('permintaan_surat','Permintaan_suratController');
Route::get('downloadZip', 'Dokumen_pekerjaanController@downloadZip');

//users
Route::post('tambah_user','UsersController@tambah_user');
Route::post('input_user_proses','UsersController@input_user_proses');
Route::post('edit_user','UsersController@edit_user');
Route::post('edit_user_proses','UsersController@edit_user_proses');
Route::post('hapus_user','UsersController@hapus_user');


//jenis laporan
Route::post('jenis_laporan','Jenis_laporanController@jenis_laporan');
Route::get('jenis_laporan','BulananController@index');

Route::post('tambah_jenis_laporan','Jenis_laporanController@form_tambah');
Route::post('tambah_jenis_laporan_proses','Jenis_laporanController@tambah');
Route::post('edit_jenis_laporan','Jenis_laporanController@form_edit');
Route::post('edit_jenis_laporan_proses','Jenis_laporanController@edit');
Route::post('hapus_jenis_laporan','Jenis_laporanController@hapus');
Route::post('selesai_melapor','Jenis_laporanController@selesai_melapor');
Route::post('kirim_notif_ke_pelapor','Jenis_laporanController@kirim_notif_ke_pelapor');

//wilayah operasi
Route::post('wilayah_operasi','Wilayah_operasiController@wilayah_operasi');
Route::get('wilayah_operasi','BulananController@index');

Route::post('tambah_wilayah_operasi','Wilayah_operasiController@form_tambah');
Route::post('tambah_wilayah_operasi_proses','Wilayah_operasiController@tambah');
Route::post('edit_wilayah_operasi','Wilayah_operasiController@form_edit');
Route::post('edit_wilayah_operasi_proses','Wilayah_operasiController@edit');
Route::post('hapus_wilayah_operasi','Wilayah_operasiController@hapus');
Route::post('kirim_notif_ke_pelapor','Wilayah_operasiController@kirim_notif_ke_pelapor');

//dokumen bulanan
Route::post('dokumen_bulanan','Dokumen_bulananController@dokumen_bulanan');
Route::get('dokumen_bulanan','BulananController@index');
Route::post('bulan_tahun','BulananController@bulan_tahun');

Route::post('tambah_dokumen_bulanan','Dokumen_bulananController@form_tambah');
Route::post('tambah_dokumen_bulanan_proses','Dokumen_bulananController@tambah');
Route::post('edit_dokumen_bulanan','Dokumen_bulananController@form_edit');
Route::post('edit_dokumen_bulanan_proses','Dokumen_bulananController@edit');
Route::post('hapus_dokumen_bulanan','Dokumen_bulananController@hapus');
Route::post('lihat_dokumen_bulanan','Dokumen_bulananController@lihat_dokumen_bulanan');
Route::post('lihat_dokumen_bulanan2','Dokumen_bulananController@lihat_dokumen_bulanan2');
Route::post('catatan','Dokumen_bulananController@catatan');
Route::post('garis','Dokumen_bulananController@garis');
Route::post('save_revisi','Dokumen_bulananController@save_revisi');
Route::post('save_revisi_data','Dokumen_bulananController@save_revisi_data');
Route::get('lihat_revisi','Dokumen_bulananController@lihat_revisi');
Route::post('hapus_revisi','Dokumen_bulananController@hapus_revisi');
Route::post('lihat_hapus_revisi','Dokumen_bulananController@lihat_hapus_revisi');
Route::post('tambah_revisi_hard','Dokumen_bulananController@tambah_revisi_hard');
Route::post('tampil_revisi_tabel','Dokumen_bulananController@tampil_revisi_tabel');
Route::post('pilih_user_review','Dokumen_bulananController@pilih_user_review');
Route::post('selesai_review','Dokumen_bulananController@selesai_review');

//attach
Route::post('attach','Dokumen_bulananController@form_tambah_attach');
Route::post('attach_proses','Dokumen_bulananController@tambah_attach');
Route::post('hapus_attach','Dokumen_bulananController@hapus_attach');

//dokumen pekerjaan
Route::post('dokumen_pekerjaan','Dokumen_pekerjaanController@dokumen_pekerjaan');
Route::get('dokumen_pekerjaan','PekerjaanController@index');

Route::post('tambah_dokumen_pekerjaan','Dokumen_pekerjaanController@form_tambah');
Route::post('tambah_dokumen_pekerjaan_proses','Dokumen_pekerjaanController@tambah');
Route::post('edit_dokumen_pekerjaan','Dokumen_pekerjaanController@form_edit');
Route::post('edit_dokumen_pekerjaan_proses','Dokumen_pekerjaanController@edit');
Route::post('hapus_dokumen_pekerjaan','Dokumen_pekerjaanController@hapus');
Route::post('popay','Dokumen_pekerjaanController@popay');
Route::post('popay_proses','Dokumen_pekerjaanController@popay_proses');
Route::post('popaylist','Dokumen_pekerjaanController@popaylist');
Route::post('popay_hapus','Dokumen_pekerjaanController@popay_hapus');
Route::post('popay_paid','Dokumen_pekerjaanController@popay_paid');
Route::post('popay_paid_proses','Dokumen_pekerjaanController@popay_paid_proses');
Route::post('hanya_saya','PekerjaanController@hanya_saya');
Route::get('hanya_saya','PekerjaanController@hanya_saya');

Route::post('lihat_dokumen_pekerjaan','Dokumen_pekerjaanController@lihat_dokumen_pekerjaan');
Route::get('lihat_dokumen_pekerjaan','PekerjaanController@index');

//surat-surat

Route::post('lihatsuratsurat','SuratsuratController@lihatsuratsurat');
Route::post('surat_masuk','SuratsuratController@surat_masuk');
Route::post('surat_keluar','SuratsuratController@surat_keluar');
Route::get('surat_masuk','SuratsuratController@surat_masuk');
Route::get('surat_keluar','SuratsuratController@surat_keluar');
Route::post('dokumen_pekerjaan_surat','SuratsuratController@dokumen_pekerjaan_surat');
Route::get('dokumen_pekerjaan_surat','SuratsuratController@dokumen_pekerjaan_surat'); 

//pembuatan surat

//Route::get('pembuatan_surat','Pembuatan_suratController@pembuatan_surat_email'); 
Route::post('pembuatan_surat','Pembuatan_suratController@index'); 
Route::post('tambah_dokumen','Pembuatan_suratController@tambah_dokumen');
Route::post('tambah_dokumen_proses','Pembuatan_suratController@tambah_dokumen_proses');
Route::post('lihat_pembuatan_surat','Pembuatan_suratController@lihat_pembuatan_surat'); 
Route::post('cek_pic','Pembuatan_suratController@cek_pic');
Route::post('cek_koordinator','Pembuatan_suratController@cek_koordinator');
Route::post('revisi','Pembuatan_suratController@revisi');
Route::post('selesai_revisi','Pembuatan_suratController@selesai_revisi');
Route::post('selesai_revisi_proses','Pembuatan_suratController@selesai_revisi_proses');
Route::post('tambah_pembuatan_surat_isi','Pembuatan_suratController@tambah_pembuatan_surat_isi');
Route::post('lihat_pembuatan_surat_isi','Pembuatan_suratController@lihat_pembuatan_surat_isi');
Route::post('edit_pembuatan_surat_isi','Pembuatan_suratController@edit_pembuatan_surat_isi');
Route::post('tambah_pembuatan_surat_isi_proses','Pembuatan_suratController@tambah_pembuatan_surat_isi_proses');
Route::post('edit_pembuatan_surat_isi_proses','Pembuatan_suratController@edit_pembuatan_surat_isi_proses');
Route::post('hapus_pembuatan_surat_isi','Pembuatan_suratController@hapus_pembuatan_surat_isi');
Route::post('lihat_pembuatan_surat','Pembuatan_suratController@lihat_pembuatan_surat');
Route::post('file_pembuatan_surat','Pembuatan_suratController@files');
Route::post('tambah_file_pembuatan_surat','Pembuatan_suratController@tambah_file_pembuatan_surat');
Route::post('tambah_file_pembuatan_surat_proses','Pembuatan_suratController@tambah_file_pembuatan_surat_proses');
Route::post('edit_file_pembuatan_surat','Pembuatan_suratController@edit_file_pembuatan_surat');
Route::post('edit_file_pembuatan_surat_proses','Pembuatan_suratController@edit_file_pembuatan_surat_proses');
Route::post('hapus_file_pembuatan_surat','Pembuatan_suratController@hapus_file_pembuatan_surat');
Route::post('arsip','Dokumen_pekerjaanController@form_tambah');

//dashboard
Route::post('dashboard_tahun','DashboardController@dashboardtahun');

Route::post('lihat_file_pembuatan_surat','Pembuatan_suratController@lihat_file_pembuatan_surat');

//cari_file
Route::post('carifile','PekerjaanController@carifile');

//mea
Route::post('detail_mea','MeaController@detail_mea');
Route::post('tambah_detail_mea','MeaController@tambah_detail_mea');
Route::post('tambah_detail_mea_proses','MeaController@tambah_detail_mea_proses');
Route::post('hapus_detail_mea','MeaController@hapus_detail_mea');
Route::post('import1','MeaController@import1');
Route::post('tindak_lanjut','MeaController@tindak_lanjut');
Route::post('refresh_detail_mea','MeaController@refresh_detail_mea');
Route::post('input_nomor_po','EprocController@input_nomor_po');
Route::post('input_nomor_receipt','EprocController@input_nomor_receipt');
Route::post('refresh_tindak_lanjut','MeaController@refresh_tindak_lanjut');
Route::get('export','MeaController@export_detail_mea');
Route::post('notifikasi','MeaController@notif_mea');
Route::post('notif_penindaklanjut','MeaController@notif_penindaklanjut');
Route::post('updatestatus','MeaController@updatestatus');
Route::post('edit_detail_mea','MeaController@edit_detail_mea');
Route::post('edit_detail_mea_proses','MeaController@edit_detail_mea_proses');

//permintaan_surat
Route::post('refresh_permintaan_surat','Permintaan_suratController@refresh_permintaan_surat');

//SPK DEV
Route::post('spk_dev','Dokumen_pekerjaanController@spk_dev');
Route::post('tambah_spk_dev','Dokumen_pekerjaanController@tambah_spk_dev');
Route::post('tambah_spk_dev_proses','Dokumen_pekerjaanController@tambah_spk_dev_proses');
Route::post('spk_dev_delete','Dokumen_pekerjaanController@spk_dev_delete');

//History
Route::post('history','Pembuatan_suratController@history');
Route::post('tambah_history','Pembuatan_suratController@tambah_history');
Route::post('tambah_history_proses','Pembuatan_suratController@tambah_history_proses');
Route::post('histori','Pembuatan_suratController@histori');
Route::post('hapus_histori','Pembuatan_suratController@hapus_histori');
Route::post('notif_histori','Pembuatan_suratController@history');
});

//Perencanaan
Route::post('perencanaan_tahun','PerencanaanController@perencanaan_tahun');
Route::post('download_bulanan','BulananController@fzip');
Route::post('download_fzip','BulananController@download_fzip');

//e-proc
Route::resource('eproc','EprocController');
Route::post('print_eproc','EprocController@print_eproc');

//Dokumen Pekerjaan Pagu
Route::post('dokumen_pekerjaan_pagu','Dokumen_pekerjaanpaguController@dokumen_pekerjaan_pagu');

//Pekerjaan Pagu
Route::post('tambah_dokumen_pekerjaan_pagu','Dokumen_pekerjaanpaguController@form_tambah');
Route::post('tambah_dokumen_pekerjaan_proses_pagu','Dokumen_pekerjaanpaguController@tambah');
Route::post('edit_dokumen_pekerjaan_pagu','Dokumen_pekerjaanpaguController@form_edit');
Route::post('edit_dokumen_pekerjaan_proses_pagu','Dokumen_pekerjaanpaguController@edit');
Route::post('spk_dev_pagu','Dokumen_pekerjaanpaguController@spk_dev');
Route::post('tambah_spk_dev_pagu','Dokumen_pekerjaanpaguController@tambah_spk_dev');
Route::post('tambah_spk_dev_proses_pagu','Dokumen_pekerjaanpaguController@tambah_spk_dev_proses');
Route::post('spk_dev_delete_pagu','Dokumen_pekerjaanpaguController@spk_dev_delete');
Route::post('popaylistpagu','Dokumen_pekerjaanpaguController@popaylist');
Route::post('popay_pagu','Dokumen_pekerjaanpaguController@popay');
Route::post('popay_proses_pagu','Dokumen_pekerjaanpaguController@popay_proses');
Route::post('popay_paid_pagu','Dokumen_pekerjaanpaguController@popay_paid');
Route::post('popay_paid_proses_pagu','Dokumen_pekerjaanpaguController@popay_paid_proses');
Route::post('popay_hapus_pagu','Dokumen_pekerjaanpaguController@popay_hapus');
Route::post('hapus_dokumen_pekerjaan_pagu','Dokumen_pekerjaanpaguController@hapus');
Route::post('lihat_dokumen_pekerjaan_pagu','Dokumen_pekerjaanpaguController@lihat_dokumen_pekerjaan');

//Jenis Pekerjaan


//email notification
Route::post('email_notification','Dokumen_pekerjaanController@email_notification');

