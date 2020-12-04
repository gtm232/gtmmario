<?php
return response()->download(public_path('laporan_bulanan/download/'.$nama_bulan.'.zip'));
		$files    =glob('public/laporan_bulanan/download/*');
		foreach ($files as $file) {
			if (is_file($file))
			unlink($file); // hapus file
		}
?>