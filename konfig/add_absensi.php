<?php

if (isset($_POST['add_absensi'])) {
	if (isset($_REQUEST['ajax'])) {
		require_once '../konfig/connection.php';
		require_once '../konfig/dev.php';
		require_once '../func/func_absensi.php';

		$id_tipe_presensi = $_POST['id_tipe_presensi'];
		$id_tipe_presensi = explode('-', $id_tipe_presensi);
		// pr($id_tipe_presensi);

		$id_divisi = $_POST['id_divisi'];
		$id_karyawan = $_POST['id_karyawan'];
		$karyawan = $_POST['karyawan'];
		$masuk = $_POST['masuk'];
		$keluar = $_POST['keluar'];
		$date = $_POST['date'];
		$status = $_POST['status'];
		$mode = 'manual';
		// $capture = $_POST['capture'];
		$keterangan = $_POST['keterangan'];
		// $potongan = $_POST['potongan'];

		$valid = IsNotDuplicate([
			'id_karyawan' => $id_karyawan,
			'tanggal' => $date,
		]);

		$kalku = GetKeterlambatan([
			'id_divisi' => $id_divisi,
			'masuk' => $masuk,
			'keluar' => $keluar,
		]);
		// pr($kalku);
		$potongan = $kalku['tot_potongan'];
		$terlambat = $kalku['tot_terlambat'];
		if ($valid) {
			// vd('$valid');
			$query = "INSERT INTO `tb_absen` (
				`id_karyawan`
				,`id_tipe_presensi`
				,`masuk`
				,`keluar`
				,`date`
				,`status`
				,`mode`
				,`keterangan`
				,`potongan`
				,`terlambat`
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
				,'$potongan'
				,'$terlambat'
			)";
			$exe = mysqli_query($dbconnect, $query);
			$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
			$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
			echo $ret;
		} else { 
			$ret = json_encode(['msg' => 'data karyawan dengan nama yang sama dan di hari yang sama sudah terdaftar', 'status' => false]);
			echo $ret;
		}
	} else {
		require_once './dev.php';
		require_once 'connection.php';
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
		header("location:../index.php?page=absensi&error=" . $error);
	}
} else {
	header("location:../index.php?page=absensi&error=" . $error);
}
