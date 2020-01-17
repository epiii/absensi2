<?php

if (isset($_POST['add_absensi'])) {
	if (isset($_REQUEST['ajax'])) {
		require_once '../konfig/connection.php';
		require_once '../konfig/dev.php';
		require_once '../func/func_absensi.php';

		$id_tipe_presensi = $_POST['id_tipe_presensi'];
		$id_tipe_presensi = explode('-', $id_tipe_presensi);

		$id_divisi = $_POST['id_divisi'];
		$id_karyawan = $_POST['id_karyawan'];
		$karyawan = $_POST['karyawan'];
		$masuk = $_POST['masuk'];
		$keluar = $_POST['keluar'];
		$date = $_POST['date'];
		$status = $_POST['status'];
		$mode = 'manual';
		$keterangan = $_POST['keterangan'];
		// $capture = $_POST['capture'];
		// $potongan = $_POST['potongan'];

		$valid = IsNotDuplicate([
			'id_karyawan' => $id_karyawan,
			'id_tipe_presensi' => $id_tipe_presensi[0],
			'tanggal' => $date,
		]);

		$terlambat_keluar = 0;
		$terlambat_masuk = 0;
		$terlambat_total = 0;
		$potongan_total = 0;
		$potongan_masuk = 0;
		$potongan_keluar = 0;

		$kat_terlambat_masuk = 0;
		$kat_terlambat_keluar = 0;

		$itp = $id_tipe_presensi[1];
		if ($itp == 'skj' || $itp == 'diklat') {
			$potongan_total = '2'; // 2 %
		} else if ($itp == 'dispensasi') {
			$potongan_total = '3'; // 3 %
		} else { // harian
			if ($status == 'H') {
				$kalku = GetKeterlambatan([
					'id_divisi' => $id_divisi,
					'masuk' => $masuk,
					'keluar' => $keluar,
				]);
				// vd($kalku);

				// kategori telat 
				$kat_terlambat_masuk = $kalku['kat_terlambat_masuk'];
				$kat_terlambat_keluar = $kalku['kat_terlambat_keluar'];

				// terlambat (menit)
				$terlambat_masuk = $kalku['terlambat_masuk'];
				$terlambat_keluar = $kalku['terlambat_keluar'];
				$terlambat_total = $kalku['terlambat_total'];

				// potongan (persen %)
				$potongan_masuk = $kalku['potongan_masuk'];
				$potongan_keluar = $kalku['potongan_keluar'];
				$potongan_total = $kalku['potongan_total'];
			} else if ($status == 'A') {
				$kat_terlambat_masuk = 4;
				$kat_terlambat_keluar = 4;
				$masuk = '';
				$keluar = '';
			} 
		}

		if ($valid) {
			$query = "INSERT INTO `tb_absen` (
				`id_karyawan`
				,`id_tipe_presensi`
				,`masuk`
				,`masuk_minus`
				,`keluar`
				,`keluar_minus`
				,`date`
				,`status`
				,`mode`
				,`keterangan`
				,`potongan`
				,`potongan_masuk`
				,`potongan_keluar`
				,`terlambat`
				,`kat_terlambat_masuk`
				,`kat_terlambat_keluar`
			)
			VALUES (
				'$id_karyawan'
				,'$id_tipe_presensi[0]'
				,'$masuk'
				,'$terlambat_masuk'
				,'$keluar'
				,'$terlambat_keluar'
				,'$date'
				,'$status'
				,'$mode'
				,'$keterangan'
				,'$potongan_total'
				,'$potongan_masuk'
				,'$potongan_keluar'
				,'$terlambat_total'
				,'$kat_terlambat_masuk'
				,'$kat_terlambat_keluar'
			)";
			// vd($query);
			$exe = mysqli_query($dbconnect, $query);
			$msg = $exe ? 'success' : 'failed,' . mysqli_error($dbconnect);
			$ret = json_encode(['msg' => $msg, 'status' => $exe ? true : false]);
			echo $ret;
		} else {
			$ret = json_encode(['msg' => 'data duplikat, (karyawan sudah melakukan presensi, tanggal dan tipe presensi sama) ', 'status' => false]);
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
