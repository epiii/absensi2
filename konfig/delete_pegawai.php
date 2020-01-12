<?php
session_start();
require_once './dev.php';
require_once 'connection.php';

if (isset($_SESSION['page'])) {
	if (isset($_GET['id'])) {
		$query = "DELETE  FROM `tb1_karyawan` WHERE id='" . $_GET['id'] . "'";
		// vd($query);

		$sql = mysqli_query($dbconnect, $query);
		if ($sql) {
			$error = "false";
		} else {
			$error = "true";
		}
	} else {
		$error = "true";
	}
} else {
	$error = "true";
}
header("location:../index.php?page=pegawai&error=" . $error);
