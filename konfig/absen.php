<?php
// session_start();
include 'function.php';
// require_once '../func/func_absensi.php';
// include '../func/func_pegawai.php';
include '../konfig/dev.php';

if (isset($_POST['id'])) {

	// $time_start= microtime(true);
	$uid = trim($_POST['id']);
	$hari_ini = date('Y-m-d');
	$day = getday($hari_ini);
	$cek = uid($uid); // 0 = ada pegawai | 1 =  tdk ada pgawai
	// pr($cek);
	// $time_end = microtime(true);
	// $execution_time = ($time_end - $time_start) / 60;
	// vd($execution_time);


	if ($cek == '0') { // id terdaftar
		$karyawan = getPegawaiById($uid);
		// pr($karyawan['id_divisi']);
		$liburHariBesar = IsHoliday_(date('Y-m-d')); // 0 = tidak libur | 1 = libur
		$liburWeekend = IsHoliday2_(date('Y-m-d'), $karyawan['id_divisi']); // 0 = tidak libur | 1 = libur
		
		if ($liburWeekend == '1' || $liburHariBesar == '1') {
			echo "Hari Libur";
		} else {
			// pr('gak llibur');
			$time = date('H:i:s');
			// mode absen : masuk / pulang 
			$mode = getModeAbsen($karyawan['id_divisi']);
			// pr($mode);

			if ($mode == 'off') {
				echo "jam absen off";
			} else { // masuk / keluar
				$submit  = postdata($uid, $karyawan['id_divisi'], $mode);
				// vd('gak off');
				echo $submit;
			}
		}
	} else {
		echo "ID Tidak Ada";
	}
} else {
	echo "Coba Lagi";
}
