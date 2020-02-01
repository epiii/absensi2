<?php
// session_start();
include 'function.php';
// require_once '../func/func_absensi.php';
// include '../func/func_pegawai.php';
include '../konfig/dev.php';

if (isset($_POST['id'])) {

	$uid = trim($_POST['id']);
	$hari_ini = date('Y-m-d');
	$day = getday($hari_ini);
	$cek = uid($uid);

	if ($cek == '0') { // id terdaftar
		$karyawan = getPegawaiById($uid);
		$liburHariBesar = IsHoliday_(date('Y-m-d'));
		$liburWeekend = IsHoliday2_(date('Y-m-d'), $karyawan['id_divisi']);

		if ($liburWeekend == '1' || $liburHariBesar == '1') {
			echo "Hari Libur";
		} else {
			$time = date('H:i:s');
			// mode absen : masuk / pulang 
			$mode = getModeAbsen($karyawan['id_divisi']);

			if ($mode == 'off') {
				echo "Absen tidak aktif, Di luar jam kerja";
			} else { // masuk / keluar
				$submit  = postdata($uid, $karyawan['id_divisi'], $mode);
				echo $submit;
			}
		}
	} else {
		echo "ID Tidak Ada";
	}
} else {
	echo "Coba Lagi";
}
