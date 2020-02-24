<?php
session_start();
require_once './dev.php';

if (isset($_SESSION['page'])) {
	// pr('$_REQUEST');

	if (isset($_POST['id']) && isset($_POST['param'])) {
		include 'connection.php';
		$id = trim($_POST['id']);
		$parameter = trim($_POST['param']);
		// $id = mysql_real_escape_string(trim($_POST['id']));
		// $parameter = mysql_real_escape_string(trim($_POST['param']));
		$kolom = "";

		if ($id == '1') {
			$kolom = "masuk_mulai";
		} else if ($id == '2') {
			$kolom = "masuk_akhir";
		} else if ($id == '3') {
			$kolom = "keluar_mulai";
		} else if ($id == '4') {
			$kolom = "keluar_akhir";
		} else if ($id == '5') {
			$kolom = "libur1";
		} else if ($id == '6') {
			$kolom = "libur2";
		} else if ($id == 'timezone') {
			$kolom = "timezone";
		} else if ($id == 'email') {
			$kolom = "email";
		} else if ($id == 'pwdemail') {
			$kolom = "pwdemail";
		} else if ($id == 'admin_uid') {
			$kolom = "admin_uid";
		}
/* 		if ($id == '1') {
			$kolom = "masuk_mulai";
		} else if ($id == '2') {
			$kolom = "masuk_akhir";
		} else if ($id == '3') {
			$kolom = "keluar_mulai";
		} else if ($id == '4') {
			$kolom = "keluar_akhir";
		} else if ($id == '5') {
			$kolom = "libur1";
		} else if ($id == '6') {
			$kolom = "libur2";
		} else if ($id == '7') {
			$kolom = "timezone";
		} else if ($id == '8') {
			$kolom = "email";
		} else if ($id == '9') {
			$kolom = "pwdemail";
		} else if ($id == '10') {
			$kolom = "admin_uid";
		}
 */
		$ss = "UPDATE tb_settings SET $kolom='$parameter'";
		// pr($ss);
		$sql = mysqli_query($dbconnect, $ss);

		if ($sql) {
			header("location:../index.php?page=konfigurasi");
		} else {
			header("location:../index.php?page=konfigurasi&error=true");
		}
	} else {
		header("location:../index.php?page=konfigurasi&error=true");
	}
} else {
	header("location:../index.php?page=konfigurasi&error=true");
}
