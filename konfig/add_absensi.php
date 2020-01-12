<?php
require_once './dev.php';
require_once 'connection.php';

if (isset($_POST['add_absensi'])) {
	// $username = mysql_real_escape_string(trim($_POST['username']));
	// $password = mysql_real_escape_string(trim($_POST['password']));

	$id_tipe_presensi = $_POST['id_tipe_presensi'];
	$id_tipe_presensi = explode('-', $id_tipe_presensi);
	// pr($id_tipe_presensi);

	$id_karyawan = $_POST['karyawan'];
	$masuk = $_POST['masuk'];
	$keluar = $_POST['keluar'];
	$date = $_POST['date'];
	$status = $_POST['status'];
	$mode = 'manual';
	// $capture = $_POST['capture'];
	$keterangan = $_POST['keterangan'];
	// $potongan = $_POST['potongan'];

	$query = "INSERT INTO `tb_absen` (
		`id_karyawan`
		,`id_tipe_presensi`
		,`masuk`
		,`keluar`
		,`date`
		,`status`
		,`mode`
		,`keterangan`
	)
	VALUES (
		'$id_karyawan'
		,'$id_tipe_presensi[0]'
		,'$masuk'
		,'$keluar'
		,'$date'
		,'$status'
		,'$mode'
		,'$keterangan'
	)";

	pr($query);
	$sql = mysqli_query($dbconnect, $query);
	// vd($sql);
	if ($sql) {
		$error = 'false';
	} else {
		$error = 'true';
	}
} else {
	$error = 'true';
}
header("location:../index.php?page=absensi&error=" . $error);
